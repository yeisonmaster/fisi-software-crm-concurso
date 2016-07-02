<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property integer $id
 * @property integer $tipo_pedido_id
 * @property integer $interlocutor_comercial_id
 *
 * @property InterlocutorComercial $interlocutorComercial
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_pedido_id', 'interlocutor_comercial_id'], 'required'],
            [['tipo_pedido_id', 'interlocutor_comercial_id'], 'integer'],
            [['interlocutor_comercial_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterlocutorComercial::className(), 'targetAttribute' => ['interlocutor_comercial_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_pedido_id' => 'Tipo Pedido ID',
            'interlocutor_comercial_id' => 'Interlocutor Comercial ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterlocutorComercial()
    {
        return $this->hasOne(InterlocutorComercial::className(), ['id' => 'interlocutor_comercial_id']);
    }
}
