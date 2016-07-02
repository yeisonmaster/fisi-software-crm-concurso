/** STORE PROCEDURE para listar los premios del del ranking anual **/
DELIMITER //
CREATE PROCEDURE SP_LISTA_PREMIOS_CAMPANA
(IN CAMPANA_ID int)
BEGIN

	set @campana_id = CAMPANA_ID;

	select 
		campana.id as campana_id,
		premio_producto.id as premio_producto_id,
		premio_producto.nombre as premio_producto_nombre,
	    premio_producto.puntaje_con_canje as puntaje_con_caje,
	    premio_producto.puntaje_sin_canje as puntaje_sin_caje
	from premio_producto
	inner join campana
	on	campana.id = premio_producto.campana_id
	inner join producto
	on	producto.id = premio_producto.producto_id
	where
		campana.id = @campana_id;

END //
DELIMITER ;