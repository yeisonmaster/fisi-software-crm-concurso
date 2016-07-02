<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ranking_anual".
 *
 * @property integer $anio
 * @property string $nombre
 * @property string $fecha_ranking
 *
 * @property NivelPremioAnual[] $nivelPremioAnuals
 * @property NivelRanking[] $nivelRankings
 */
class RankingAnual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ranking_anual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_ranking'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anio' => 'Anio',
            'nombre' => 'Nombre',
            'fecha_ranking' => 'Fecha Ranking',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelPremioAnuals()
    {
        return $this->hasMany(NivelPremioAnual::className(), ['ranking_anual_anio' => 'anio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelRankings()
    {
        return $this->hasMany(NivelRanking::className(), ['id' => 'nivel_ranking_id'])->viaTable('nivel_premio_anual', ['ranking_anual_anio' => 'anio']);
    }
}
