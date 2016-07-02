/** STORE PROCEDURE para listar los premios del del ranking anual **/
DELIMITER //
CREATE PROCEDURE SP_LISTA_PREMIOS_RANKING_ANUAL
(IN ANIO int)
BEGIN

	set @anio = ANIO;

	select 
	    ranking_anual.anio as ranking_anual_anio,
	    ranking_anual.nombre as ranking_anual_nombre,
	    premio_ranking.id as premio_ranking_id,
	    nivel_ranking.nombre as nivel_ranking_nombre,
	    premio_ranking.nombre as premio_nombre
	from premio_ranking
	inner join nivel_premio_anual
	on	nivel_premio_anual.ranking_anual_anio = premio_ranking.nivel_premio_anual_ranking_anual_anio and
		nivel_premio_anual.nivel_ranking_id = premio_ranking.nivel_premio_anual_nivel_ranking_id and
		nivel_premio_anual.ranking_anual_anio = @anio
	inner join nivel_ranking
	on	nivel_ranking.id = nivel_premio_anual.nivel_ranking_id
	inner join ranking_anual
	on	ranking_anual.anio = nivel_premio_anual.ranking_anual_anio and
		ranking_anual.anio = @anio
	where
		ranking_anual.anio = @anio;

END //
DELIMITER ;