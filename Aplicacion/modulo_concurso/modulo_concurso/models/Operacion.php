<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operacion".
 *
 * @property integer $id
 * @property integer $tipo_operacion_id
 * @property integer $pedido_id
 * @property string $codigo_operacion
 * @property string $monto_operacion
 * @property integer $estado
 * @property string $observacion
 * @property string $fecha_operacion
 */
class Operacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_operacion_id', 'pedido_id', 'observacion'], 'required'],
            [['tipo_operacion_id', 'pedido_id', 'estado'], 'integer'],
            [['monto_operacion'], 'number'],
            [['fecha_operacion'], 'safe'],
            [['codigo_operacion'], 'string', 'max' => 255],
            [['observacion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_operacion_id' => 'Tipo Operacion ID',
            'pedido_id' => 'Pedido ID',
            'codigo_operacion' => 'Codigo Operacion',
            'monto_operacion' => 'Monto Operacion',
            'estado' => 'Estado',
            'observacion' => 'Observacion',
            'fecha_operacion' => 'Fecha Operacion',
        ];
    }
}
