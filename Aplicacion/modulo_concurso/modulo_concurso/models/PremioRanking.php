<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "premio_ranking".
 *
 * @property integer $id
 * @property integer $nivel_premio_anual_nivel_ranking_id
 * @property integer $nivel_premio_anual_ranking_anual_anio
 * @property string $nombre
 * @property integer $estado
 *
 * @property EntregaPremioRanking[] $entregaPremioRankings
 * @property InterlocutorComercial[] $interlocutorComercials
 * @property NivelPremioAnual $nivelPremioAnualRankingAnualAnio
 */
class PremioRanking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premio_ranking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nivel_premio_anual_nivel_ranking_id', 'nivel_premio_anual_ranking_anual_anio'], 'required'],
            [['nivel_premio_anual_nivel_ranking_id', 'nivel_premio_anual_ranking_anual_anio', 'estado'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['nivel_premio_anual_ranking_anual_anio', 'nivel_premio_anual_nivel_ranking_id'], 'exist', 'skipOnError' => true, 'targetClass' => NivelPremioAnual::className(), 'targetAttribute' => ['nivel_premio_anual_ranking_anual_anio' => 'ranking_anual_anio', 'nivel_premio_anual_nivel_ranking_id' => 'nivel_ranking_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nivel_premio_anual_nivel_ranking_id' => 'Nivel Premio Anual Nivel Ranking ID',
            'nivel_premio_anual_ranking_anual_anio' => 'Nivel Premio Anual Ranking Anual Anio',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntregaPremioRankings()
    {
        return $this->hasMany(EntregaPremioRanking::className(), ['premio_ranking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterlocutorComercials()
    {
        return $this->hasMany(InterlocutorComercial::className(), ['id' => 'interlocutor_comercial_id'])->viaTable('entrega_premio_ranking', ['premio_ranking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelPremioAnualRankingAnualAnio()
    {
        return $this->hasOne(NivelPremioAnual::className(), ['ranking_anual_anio' => 'nivel_premio_anual_ranking_anual_anio', 'nivel_ranking_id' => 'nivel_premio_anual_nivel_ranking_id']);
    }
}
