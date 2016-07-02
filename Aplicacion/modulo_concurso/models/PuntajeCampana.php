<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puntaje_campana".
 *
 * @property integer $campana_id
 * @property integer $interlocutor_comercial_id
 * @property integer $puntaje_actual
 * @property integer $puntaje_acumulado
 *
 * @property Campana $campana
 * @property InterlocutorComercial $interlocutorComercial
 */
class PuntajeCampana extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puntaje_campana';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campana_id', 'interlocutor_comercial_id'], 'required'],
            [['campana_id', 'interlocutor_comercial_id', 'puntaje_actual', 'puntaje_acumulado'], 'integer'],
            [['campana_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campana::className(), 'targetAttribute' => ['campana_id' => 'id']],
            [['interlocutor_comercial_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterlocutorComercial::className(), 'targetAttribute' => ['interlocutor_comercial_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campana_id' => 'Campana ID',
            'interlocutor_comercial_id' => 'Interlocutor Comercial ID',
            'puntaje_actual' => 'Puntaje Actual',
            'puntaje_acumulado' => 'Puntaje Acumulado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampana()
    {
        return $this->hasOne(Campana::className(), ['id' => 'campana_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterlocutorComercial()
    {
        return $this->hasOne(InterlocutorComercial::className(), ['id' => 'interlocutor_comercial_id']);
    }
}
