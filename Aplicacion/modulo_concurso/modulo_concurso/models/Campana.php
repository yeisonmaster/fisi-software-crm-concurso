<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campana".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $estado
 * @property integer $codigo_mes
 *
 * @property EntregaPremio[] $entregaPremios
 * @property EntregaPremio[] $entregaPremios0
 * @property PremioProducto[] $premioProductos
 * @property PuntajeCampana[] $puntajeCampanas
 * @property InterlocutorComercial[] $interlocutorComercials
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
            [['estado', 'codigo_mes'], 'integer'],
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
            'codigo_mes' => 'Codigo Mes',
        ];
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
    public function getPuntajeCampanas()
    {
        return $this->hasMany(PuntajeCampana::className(), ['campana_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterlocutorComercials()
    {
        return $this->hasMany(InterlocutorComercial::className(), ['id' => 'interlocutor_comercial_id'])->viaTable('puntaje_campana', ['campana_id' => 'id']);
    }
}
