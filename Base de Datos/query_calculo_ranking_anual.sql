/** STORE PROCEDURE para calcular los puntajes en el ranking anual, no se consideran canjes **/
DELIMITER //
CREATE PROCEDURE SP_CALCULAR_PUNTAJE_RANKING_ANUAL
(IN FECHA_OPERACION datetime)
BEGIN

	set @anio = (select extract(YEAR FROM FECHA_OPERACION));

	/** Eliminar los calculos del puntaje anual **/
	delete 
	from puntaje_anual 
	where ranking_anual_anio = @anio;

	/** Calculo del ranking (por año) **/
	insert into puntaje_anual
		(ranking_anual_anio, interlocutor_comercial_id, puntaje_acumulado)
	select 
		year(fecha_operacion) as ranking_anual_anio, 
		pedido.interlocutor_comercial_id, 
		sum(operacion.monto_operacion) as puntaje_acumulado
	from 	pedido
	inner join operacion
	on 	pedido.id = operacion.pedido_id
	where
		year(operacion.fecha_operacion) = @anio
	group by
		ranking_anual_anio,
		interlocutor_comercial_id;

END //
DELIMITER ;

/** TRIGGER a dispararse despues del insert en cada OPERACION nueva  **/
DELIMITER // 
CREATE TRIGGER CALCULAR_PUNTAJE_RANKING_ANUAL_OPERACION_AI_TRIGGER 
AFTER INSERT ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_RANKING_ANUAL(NEW.fecha_operacion);
END //
DELIMITER ;

/** TRIGGER antes del update en cada OPERACION nueva  **/
CREATE TRIGGER CALCULAR_PUNTAJE_RANKING_ANUAL_OPERACION_BU_TRIGGER 
BEFORE UPDATE ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_RANKING_ANUAL(OLD.fecha_operacion);
END //
DELIMITER ;

/** TRIGGER despues del update en cada OPERACION nueva  **/
CREATE TRIGGER CALCULAR_PUNTAJE_RANKING_ANUAL_OPERACION_AU_TRIGGER 
AFTER UPDATE ON operacion 
FOR EACH ROW 
BEGIN 
	CALL SP_CALCULAR_PUNTAJE_RANKING_ANUAL(OLD.fecha_operacion);
END //
DELIMITER ;