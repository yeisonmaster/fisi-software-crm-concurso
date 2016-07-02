<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $id
 * @property integer $familia_id
 * @property string $codigo
 * @property string $nombre
 * @property integer $unidad
 * @property string $precio
 * @property string $precio_vta
 * @property integer $descuento
 * @property integer $estado
 *
 * @property PremioProducto[] $premioProductos
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['familia_id'], 'required'],
            [['familia_id', 'unidad', 'descuento', 'estado'], 'integer'],
            [['precio', 'precio_vta'], 'number'],
            [['codigo'], 'string', 'max' => 10],
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
            'familia_id' => 'Familia ID',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'unidad' => 'Unidad',
            'precio' => 'Precio',
            'precio_vta' => 'Precio Vta',
            'descuento' => 'Descuento',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPremioProductos()
    {
        return $this->hasMany(PremioProducto::className(), ['producto_id' => 'id']);
    }
}
