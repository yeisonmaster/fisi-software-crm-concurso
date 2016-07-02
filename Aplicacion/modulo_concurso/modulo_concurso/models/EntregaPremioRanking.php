<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrega_premio_ranking".
 *
 * @property integer $interlocutor_comercial_id
 * @property integer $premio_ranking_id
 * @property string $fecha_entrega
 *
 * @property InterlocutorComercial $interlocutorComercial
 * @property PremioRanking $premioRanking
 */
class EntregaPremioRanking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrega_premio_ranking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['interlocutor_comercial_id', 'premio_ranking_id'], 'required'],
            [['interlocutor_comercial_id', 'premio_ranking_id'], 'integer'],
            [['fecha_entrega'], 'safe'],
            [['interlocutor_comercial_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterlocutorComercial::className(), 'targetAttribute' => ['interlocutor_comercial_id' => 'id']],
            [['premio_ranking_id'], 'exist', 'skipOnError' => true, 'targetClass' => PremioRanking::className(), 'targetAttribute' => ['premio_ranking_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'interlocutor_comercial_id' => 'Interlocutor Comercial ID',
            'premio_ranking_id' => 'Premio Ranking ID',
            'fecha_entrega' => 'Fecha Entrega',
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
    public function getPremioRanking()
    {
        return $this->hasOne(PremioRanking::className(), ['id' => 'premio_ranking_id']);
    }
}
