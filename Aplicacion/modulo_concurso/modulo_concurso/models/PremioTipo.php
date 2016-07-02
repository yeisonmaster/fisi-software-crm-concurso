<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "premio_tipo".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $estado
 *
 * @property EntregaPremio[] $entregaPremios
 */
class PremioTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premio_tipo';
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
    public function getEntregaPremios()
    {
        return $this->hasMany(EntregaPremio::className(), ['premio_tipo_id' => 'id']);
    }
}
