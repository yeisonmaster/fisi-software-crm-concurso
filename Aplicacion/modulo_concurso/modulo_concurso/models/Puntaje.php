<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puntaje".
 *
 * @property integer $campana_id
 * @property integer $pedido_detalle_id
 * @property integer $puntaje_actual
 * @property integer $puntaje_acumulado
 *
 * @property Campana $campana
 * @property PedidoDetalle $pedidoDetalle
 */
class Puntaje extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puntaje';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campana_id', 'pedido_detalle_id'], 'required'],
            [['campana_id', 'pedido_detalle_id', 'puntaje_actual', 'puntaje_acumulado'], 'integer'],
            [['campana_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campana::className(), 'targetAttribute' => ['campana_id' => 'id']],
            [['pedido_detalle_id'], 'exist', 'skipOnError' => true, 'targetClass' => PedidoDetalle::className(), 'targetAttribute' => ['pedido_detalle_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campana_id' => 'Campana ID',
            'pedido_detalle_id' => 'Pedido Detalle ID',
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
    public function getPedidoDetalle()
    {
        return $this->hasOne(PedidoDetalle::className(), ['id' => 'pedido_detalle_id']);
    }
}
