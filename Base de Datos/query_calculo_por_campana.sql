/** STORE PROCEDURE para calcular los puntajes en las campañas **/
DELIMITER //
CREATE PROCEDURE SP_CALCULAR_PUNTAJE_CAMPANA
(IN FECHA_OPERACION datetime, IN CAMPANA_ID int)
BEGIN
	
	/** Utilizamos la fecha de modificacion, si la campana es nula **/
  	IF CAMPANA_ID IS NULL THEN 

	/** Obteniendo el codigo_mes **/
	set @codigo_mes = year(FECHA_OPERACION)*10 + month(FECHA_OPERACION);

	/** Obteniendo el identificador de la campaña a recalcular **/
	set @campana_id = (select campana_id from campana where codigo_mes = @codigo_mes);

	/** Utilizamos el codigo de la campana, si la campana es enviada **/
	ELSE

	/** Obteniendo el codigo_mes **/
	set @codigo_mes = (select codigo_mes from campana where campana_id = CAMPANA_ID);

	/** Obteniendo el identificador de la campaña a recalcular **/
	set @campana_id = CAMPANA_ID;

	END IF;

	/** Codigo del Id del tipo de premio que aplica descuento **/
	@id_premio_tipo_con_canje = '1';

	/** Eliminar los calculos del puntaje de la campana mensual **/
	delete 
	from puntaje_campana 
	where campana_id = @campana_id;

	/** Calculo mensual (por campana) **/
	insert into puntaje_campana
		(campana_id, interlocutor_comercial_id, puntaje_acumulado)
	select 
		@campana_id as campana_id, 
		pedido.interlocutor_comercial_id, 
		sum(operacion.monto_operacion) as puntaje_acumulado
	from 	pedido
	inner join operacion
	on 	pedido.id = operacion.pedido_id
	where
		year(operacion.fecha_operacion)*10 + 
		month(operacion.fecha_operacion) = @codigo_mes
	group by
		campana_id,
		interlocutor_comercial_id;

	/** Quitar al puntaje acumualado los puntajes consumidos (puntaje actual) **/
	update puntaje_campana
	left join
	(
		select 
			entrega_premio.campana_solicitud as campana_id,
			entrega_premio.interlocutor_comercial_id,
			sum(premio_producto.puntaje_con_caje) as monto_premiado
		from entrega_premio
		inner join premio_tipo
		on	entrega_premio.premio_tipo_id = premio_tipo.id and
			entrega_premio.premio_tipo_id = @id_premio_tipo_con_canje -- Con Caje osea se descuenta
		inner join premio_producto
		on	entrega_premio.premio_producto_id = premio_producto.id
		where entrega_premio.campana_solicitud = @campana_id
		group by
			entrega_premio.campana_solicitud,
			entrega_premio.interlocutor_comercial_id
	) as calculo_premiado
	on	puntaje_campana.campana_id = calculo_premiado.campana_id and
		puntaje_campana.interlocutor_comercial_id = calculo_premiado.interlocutor_comercial_id
	set puntaje_actual = puntaje_acumulado - monto_premiado;

END //
DELIMITER ;

/** TRIGGER a dispararse despues del insert en cada OPERACION nueva  **/
DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_AI_TRIGGER 
AFTER INSERT ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NEW.fecha_operacion, NULL);
END //
DELIMITER ;

/** TRIGGER despues del update en cada OPERACION nueva  **/
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_AU_TRIGGER 
BEFORE UPDATE ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(OLD.fecha_operacion, NULL);
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NEW.fecha_operacion, NULL);
END //
DELIMITER ;

/** TRIGGER despues del delete en cada OPERACION nueva  **/
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_BD_TRIGGER 
BEFORE DELETE ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NULL, OLD.campana_solicitud);
END //
DELIMITER ;

/** TRIGGER a dispararse despues del insert en cada ENTREGA PREMIO por campaña nueva  **/
DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_AI_TRIGGER 
AFTER INSERT ON entrega_premio 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NULL, NEW.campana_solicitud);
END //
DELIMITER ;

/** TRIGGER despues del update en cada ENTREGA PREMIO por campaña nueva  **/
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_AU_TRIGGER 
BEFORE UPDATE ON entrega_premio 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NULL, OLD.campana_solicitud);
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NULL, NEW.campana_solicitud);
END //
DELIMITER ;

/** TRIGGER despues del delete en cada ENTREGA PREMIO por campaña nueva  **/
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_BD_TRIGGER 
BEFORE DELETE ON entrega_premio 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(OLD.fecha_operacion, NULL);
END //
DELIMITER ;