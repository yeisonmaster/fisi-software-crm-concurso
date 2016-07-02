<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_detalle".
 *
 * @property integer $id
 * @property integer $producto_id
 * @property integer $pedido_id
 *
 * @property Pedido $pedido
 * @property Producto $producto
 * @property Puntaje[] $puntajes
 * @property Campana[] $campanas
 */
class PedidoDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_detalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producto_id', 'pedido_id'], 'required'],
            [['producto_id', 'pedido_id'], 'integer'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'producto_id' => 'Producto ID',
            'pedido_id' => 'Pedido ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntajes()
    {
        return $this->hasMany(Puntaje::className(), ['pedido_detalle_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanas()
    {
        return $this->hasMany(Campana::className(), ['id' => 'campana_id'])->viaTable('puntaje', ['pedido_detalle_id' => 'id']);
    }
}
