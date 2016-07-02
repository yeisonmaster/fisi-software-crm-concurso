/** STORE PROCEDURE para listar los ganadores de la campana **/
DELIMITER //
CREATE PROCEDURE SP_LISTA_PREMIOS_CAMPANA
(IN CAMPANA_ID int)
BEGIN

	set @campana_id = CAMPANA_ID;

	select 
		campana.id as campana_id,
		interlocutor_comercial.codigo as ganador_codigo,
		interlocutor_comercial.nombre as ganador_nombre,
		premio_tipo.nombre as premio_tipo_nombre,
		premio_producto.nombre as premio_producto_nombre
	from entrega_premio
	inner join premio_producto
	on	premio_producto.id = entrega_premio.premio_producto_id
	inner join producto
	on	producto.id = premio_producto.producto_id
	inner join campana
	on	campana.id = premio_producto.campana_id
	inner join premio_tipo
	on	premio_tipo.id = entrega_premio.premio_tipo_id
	inner join interlocutor_comercial
	on	interlocutor_comercial.id = entrega_premio.interlocutor_comercial_id
	where
		campana.id = @campana_id;

END //
DELIMITER ;