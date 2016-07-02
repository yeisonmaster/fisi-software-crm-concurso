<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_ranking".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property NivelPremioAnual[] $nivelPremioAnuals
 * @property RankingAnual[] $rankingAnualAnios
 */
class NivelRanking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_ranking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelPremioAnuals()
    {
        return $this->hasMany(NivelPremioAnual::className(), ['nivel_ranking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankingAnualAnios()
    {
        return $this->hasMany(RankingAnual::className(), ['anio' => 'ranking_anual_anio'])->viaTable('nivel_premio_anual', ['nivel_ranking_id' => 'id']);
    }
}
