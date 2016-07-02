<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "premio_producto".
 *
 * @property integer $id
 * @property integer $campana_id
 * @property integer $producto_id
 * @property string $nombre
 * @property integer $estado
 * @property integer $puntaje_con_canje
 * @property integer $puntaje_sin_canje
 *
 * @property EntregaPremio[] $entregaPremios
 * @property Campana $campana
 * @property Producto $producto
 */
class PremioProducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premio_producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campana_id', 'producto_id'], 'required'],
            [['campana_id', 'producto_id', 'estado', 'puntaje_con_canje', 'puntaje_sin_canje'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['campana_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campana::className(), 'targetAttribute' => ['campana_id' => 'id']],
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
            'campana_id' => 'Campana ID',
            'producto_id' => 'Producto ID',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
            'puntaje_con_canje' => 'Puntaje Con Canje',
            'puntaje_sin_canje' => 'Puntaje Sin Canje',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntregaPremios()
    {
        return $this->hasMany(EntregaPremio::className(), ['premio_producto_id' => 'id']);
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
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }
}
