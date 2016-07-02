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
 * @property integer $puntaje_con_caje
 * @property integer $puntaje_sin_canje
 *
 * @property EntregaPremio[] $entregaPremios
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
            [['campana_id', 'producto_id', 'estado', 'puntaje_con_caje', 'puntaje_sin_canje'], 'integer'],
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
            'campana_id' => 'Campana ID',
            'producto_id' => 'Producto ID',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
            'puntaje_con_caje' => 'Puntaje Con Caje',
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
}
