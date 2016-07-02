<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrega_premio".
 *
 * @property integer $premio_producto_id
 * @property integer $premio_tipo_id
 * @property integer $interlocutor_comercial_id
 * @property integer $campana_solicitud
 * @property integer $campana_entrega
 * @property string $fecha_solicitud
 * @property string $fecha_entrega
 *
 * @property Campana $campanaSolicitud
 * @property Campana $campanaEntrega
 * @property InterlocutorComercial $interlocutorComercial
 * @property PremioProducto $premioProducto
 * @property PremioTipo $premioTipo
 */
class EntregaPremio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrega_premio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['premio_producto_id', 'premio_tipo_id', 'interlocutor_comercial_id', 'campana_solicitud', 'campana_entrega'], 'required'],
            [['premio_producto_id', 'premio_tipo_id', 'interlocutor_comercial_id', 'campana_solicitud', 'campana_entrega'], 'integer'],
            [['fecha_solicitud', 'fecha_entrega'], 'safe'],
            [['campana_solicitud'], 'exist', 'skipOnError' => true, 'targetClass' => Campana::className(), 'targetAttribute' => ['campana_solicitud' => 'id']],
            [['campana_entrega'], 'exist', 'skipOnError' => true, 'targetClass' => Campana::className(), 'targetAttribute' => ['campana_entrega' => 'id']],
            [['interlocutor_comercial_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterlocutorComercial::className(), 'targetAttribute' => ['interlocutor_comercial_id' => 'id']],
            [['premio_producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => PremioProducto::className(), 'targetAttribute' => ['premio_producto_id' => 'id']],
            [['premio_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => PremioTipo::className(), 'targetAttribute' => ['premio_tipo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'premio_producto_id' => 'Premio Producto ID',
            'premio_tipo_id' => 'Premio Tipo ID',
            'interlocutor_comercial_id' => 'Interlocutor Comercial ID',
            'campana_solicitud' => 'Campana Solicitud',
            'campana_entrega' => 'Campana Entrega',
            'fecha_solicitud' => 'Fecha Solicitud',
            'fecha_entrega' => 'Fecha Entrega',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanaSolicitud()
    {
        return $this->hasOne(Campana::className(), ['id' => 'campana_solicitud']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanaEntrega()
    {
        return $this->hasOne(Campana::className(), ['id' => 'campana_entrega']);
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
    public function getPremioProducto()
    {
        return $this->hasOne(PremioProducto::className(), ['id' => 'premio_producto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPremioTipo()
    {
        return $this->hasOne(PremioTipo::className(), ['id' => 'premio_tipo_id']);
    }
}
