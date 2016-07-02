/** STORE PROCEDURE para listar los ganadores del ranking anual **/
DELIMITER //
CREATE PROCEDURE SP_LISTA_GANADORES_RANKING_ANUAL
(IN ANIO int)
BEGIN

	set @anio = ANIO;

	select 
		interlocutor_comercial.codigo as ganador_codigo,
		interlocutor_comercial.nombre as ganador_nombre,
		puntaje_anual.puntaje_acumulado as ganador_puntaje,
		nivel_ranking.nombre as nivel_ranking_nombre,
		premio_ranking.nombre as premio_ranking_nombre
	from entrega_premio_ranking
	inner join interlocutor_comercial
	on	entrega_premio_ranking.interlocutor_comercial_id = interlocutor_comercial.id
	inner join premio_ranking
	on	premio_ranking.nivel_premio_anual_nivel_ranking_id = entrega_premio_ranking.premio_ranking_id and
		premio_ranking.nivel_premio_anual_ranking_anual_anio = @anio
	inner join nivel_premio_anual
	on	nivel_premio_anual.ranking_anual_anio = premio_ranking.nivel_premio_anual_ranking_anual_anio and
		nivel_premio_anual.nivel_ranking_id = premio_ranking.nivel_premio_anual_nivel_ranking_id and
		nivel_premio_anual.ranking_anual_anio = @anio
	inner join nivel_ranking
	on	nivel_ranking.id = nivel_premio_anual.nivel_ranking_id
	inner join ranking_anual
	on	ranking_anual.anio = nivel_premio_anual.ranking_anual_anio
		ranking_anual.anio = @anio
	inner join puntaje_anual
	on	puntaje_anual.interlocutor_comercial_id = interlocutor_comercial.id
		puntaje_anual.ranking_anual_anio = ranking_anual.anio and
		puntaje_anual.ranking_anual_anio = @anio
	where
		puntaje_anual.ranking_anual_anio = @anio
	order by
		puntaje_anual.puntaje_acumulado desc

END //
DELIMITER ;