<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_premio_anual".
 *
 * @property integer $ranking_anual_anio
 * @property integer $nivel_ranking_id
 * @property string $nombre
 * @property integer $puntaje_minimo
 * @property integer $puntaje_hasta
 *
 * @property NivelRanking $nivelRanking
 * @property RankingAnual $rankingAnualAnio
 * @property PremioRanking[] $premioRankings
 */
class NivelPremioAnual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_premio_anual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ranking_anual_anio', 'nivel_ranking_id', 'nombre', 'puntaje_minimo', 'puntaje_hasta'], 'required'],
            [['ranking_anual_anio', 'nivel_ranking_id', 'puntaje_minimo', 'puntaje_hasta'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['nivel_ranking_id'], 'exist', 'skipOnError' => true, 'targetClass' => NivelRanking::className(), 'targetAttribute' => ['nivel_ranking_id' => 'id']],
            [['ranking_anual_anio'], 'exist', 'skipOnError' => true, 'targetClass' => RankingAnual::className(), 'targetAttribute' => ['ranking_anual_anio' => 'anio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ranking_anual_anio' => 'Ranking Anual Anio',
            'nivel_ranking_id' => 'Nivel Ranking ID',
            'nombre' => 'Nombre',
            'puntaje_minimo' => 'Puntaje Minimo',
            'puntaje_hasta' => 'Puntaje Hasta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelRanking()
    {
        return $this->hasOne(NivelRanking::className(), ['id' => 'nivel_ranking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankingAnualAnio()
    {
        return $this->hasOne(RankingAnual::className(), ['anio' => 'ranking_anual_anio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPremioRankings()
    {
        return $this->hasMany(PremioRanking::className(), ['nivel_premio_anual_ranking_anual_anio' => 'ranking_anual_anio', 'nivel_premio_anual_nivel_ranking_id' => 'nivel_ranking_id']);
    }
}
