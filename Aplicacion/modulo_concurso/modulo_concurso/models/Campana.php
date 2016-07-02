<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campana".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $estado
 *
 * @property CatalogoProducto[] $catalogoProductos
 * @property EntregaPremio[] $entregaPremios
 * @property EntregaPremio[] $entregaPremios0
 * @property PremioProducto[] $premioProductos
 * @property Puntaje[] $puntajes
 * @property PedidoDetalle[] $pedidoDetalles
 */
class Campana extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campana';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
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
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoProductos()
    {
        return $this->hasMany(CatalogoProducto::className(), ['campana_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntregaPremios()
    {
        return $this->hasMany(EntregaPremio::className(), ['campana_solicitud' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntregaPremios0()
    {
        return $this->hasMany(EntregaPremio::className(), ['campana_entrega' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPremioProductos()
    {
        return $this->hasMany(PremioProducto::className(), ['campana_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntajes()
    {
        return $this->hasMany(Puntaje::className(), ['campana_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::className(), ['id' => 'pedido_detalle_id'])->viaTable('puntaje', ['campana_id' => 'id']);
    }
}
