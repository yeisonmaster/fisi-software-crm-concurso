/** STORE PROCEDURE para calcular los puntajes en las campañas **/
DROP PROCEDURE IF EXISTS SP_CALCULAR_PUNTAJE_CAMPANA;

DELIMITER //
CREATE PROCEDURE SP_CALCULAR_PUNTAJE_CAMPANA
(IN FECHA_OPERACION datetime, IN CAMPANA_ID int)
BEGIN
	
	set @codigo_mes = NULL;
	set @campana_id = NULL;

	/** Utilizamos la fecha de modificacion, si la campana es nula **/
  	IF CAMPANA_ID IS NULL THEN 

		/** Obteniendo el codigo_mes **/
		set @codigo_mes = (select extract(YEAR FROM FECHA_OPERACION)*100 + extract(MONTH FROM FECHA_OPERACION));

		/** Obteniendo el identificador de la campaña a recalcular **/
		set @campana_id = (select id from campana where codigo_mes = @codigo_mes);

	/** Utilizamos el codigo de la campana, si la campana es enviada **/
	ELSE

		/** Obteniendo el codigo_mes **/
		set @codigo_mes = (select codigo_mes from campana where id = CAMPANA_ID);

		/** Obteniendo el identificador de la campaña a recalcular **/
		set @campana_id = CAMPANA_ID;

	END IF;

	/** Codigo del Id del tipo de premio que aplica descuento **/
	set @id_premio_tipo_con_canje = 1;

	/** Eliminar los calculos del puntaje de la campana mensual **/
	delete 
	from puntaje_campana 
	where campana_id = @campana_id;

	/** Calculo mensual (por campana) **/
	insert into puntaje_campana
		(campana_id, interlocutor_comercial_id, puntaje_actual, puntaje_acumulado)
	select campana.id, interlocutor_comercial_id, puntaje_acumulado, puntaje_acumulado
	from
	campana,
	(
		select 
			extract(YEAR FROM operacion.fecha_operacion)*100 + 
			extract(MONTH FROM operacion.fecha_operacion) as operacion_codigo_mes,
			pedido.interlocutor_comercial_id, 
			sum(
				operacion.monto_operacion
			) as puntaje_acumulado
		from 	pedido
		inner join operacion
		on 	pedido.id = operacion.pedido_id
		group by
			operacion_codigo_mes,
			pedido.interlocutor_comercial_id
	) as operacion_acumulado
	where
		campana.codigo_mes = operacion_acumulado.operacion_codigo_mes and
		campana.codigo_mes = @codigo_mes;

	/** Quitar al puntaje acumualado los puntajes consumidos (puntaje actual) **/
	update puntaje_campana
	left join
	(
		select 
			entrega_premio.campana_solicitud as campana_id,
			entrega_premio.interlocutor_comercial_id,
			sum(premio_producto.puntaje_con_canje) as monto_premiado
		from entrega_premio
		inner join premio_tipo
		on	entrega_premio.premio_tipo_id = premio_tipo.id and
			entrega_premio.premio_tipo_id = @id_premio_tipo_con_canje -- Con canje osea se descuenta
		inner join premio_producto
		on	entrega_premio.premio_producto_id = premio_producto.id
		where entrega_premio.campana_solicitud = @campana_id
		group by
			entrega_premio.campana_solicitud,
			entrega_premio.interlocutor_comercial_id
	) as calculo_premiado
	on	puntaje_campana.campana_id = calculo_premiado.campana_id and
		puntaje_campana.interlocutor_comercial_id = calculo_premiado.interlocutor_comercial_id
	set puntaje_actual = puntaje_actual - monto_premiado;

END //
DELIMITER ;

/** TRIGGER a dispararse despues del insert en cada OPERACION nueva  **/
DROP TRIGGER IF EXISTS CALCULAR_PUNTAJE_CAMPANA_OPERACION_AI_TRIGGER;

DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_OPERACION_AI_TRIGGER 
AFTER INSERT ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NEW.fecha_operacion, NULL);
END //
DELIMITER ;

/** TRIGGER antes del update en cada OPERACION nueva  **/
DROP TRIGGER IF EXISTS CALCULAR_PUNTAJE_CAMPANA_OPERACION_BU_TRIGGER;

DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_OPERACION_BU_TRIGGER 
BEFORE UPDATE ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(OLD.fecha_operacion, NULL);
END //
DELIMITER ;

/** TRIGGER despues del update en cada OPERACION nueva  **/
DROP TRIGGER IF EXISTS CALCULAR_PUNTAJE_CAMPANA_OPERACION_AU_TRIGGER;

DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_OPERACION_AU_TRIGGER 
AFTER UPDATE ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(OLD.fecha_operacion, NULL);
END //
DELIMITER ;

/*********************/

/** TRIGGER a dispararse despues del insert en cada ENTREGA PREMIO por campaña nueva  **/
DROP TRIGGER IF EXISTS CALCULAR_PUNTAJE_CAMPANA_ENTREGA_PREMIO_AI_TRIGGER;

DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_ENTREGA_PREMIO_AI_TRIGGER 
AFTER INSERT ON entrega_premio 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NULL, NEW.campana_solicitud);
END //
DELIMITER ;

/** TRIGGER despues del update en cada ENTREGA PREMIO por campaña nueva  **/
DROP TRIGGER IF EXISTS CALCULAR_PUNTAJE_CAMPANA_ENTREGA_PREMIO_BU_TRIGGER;

DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_ENTREGA_PREMIO_BU_TRIGGER 
BEFORE UPDATE ON entrega_premio 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NULL, OLD.campana_solicitud);
END //
DELIMITER ;

/** TRIGGER despues del update en cada ENTREGA PREMIO por campaña nueva  **/
DROP TRIGGER IF EXISTS CALCULAR_PUNTAJE_CAMPANA_ENTREGA_PREMIO_AU_TRIGGER;

DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_CAMPANA_ENTREGA_PREMIO_AU_TRIGGER 
AFTER UPDATE ON entrega_premio 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_CAMPANA(NULL, OLD.campana_solicitud);
END //
DELIMITER ;