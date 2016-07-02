<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puntaje_anual".
 *
 * @property integer $ranking_anual_anio
 * @property integer $interlocutor_comercial_id
 * @property string $puntaje_acumulado
 *
 * @property InterlocutorComercial $interlocutorComercial
 * @property RankingAnual $rankingAnualAnio
 */
class PuntajeAnual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puntaje_anual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ranking_anual_anio', 'interlocutor_comercial_id'], 'required'],
            [['ranking_anual_anio', 'interlocutor_comercial_id'], 'integer'],
            [['puntaje_acumulado'], 'string', 'max' => 45],
            [['interlocutor_comercial_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterlocutorComercial::className(), 'targetAttribute' => ['interlocutor_comercial_id' => 'id']],
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
            'interlocutor_comercial_id' => 'Interlocutor Comercial ID',
            'puntaje_acumulado' => 'Puntaje Acumulado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterlocutorComercial()
    {
        return $this->hasOne(InterlocutorComercial::className(), ['id' => 'interlocutor_comercial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankingAnualAnio()
    {
        return $this->hasOne(RankingAnual::className(), ['anio' => 'ranking_anual_anio']);
    }
}
