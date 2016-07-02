<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interlocutor_comercial".
 *
 * @property integer $id
 * @property integer $zona_id
 * @property integer $roles_id
 * @property string $codigo
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $telefono
 * @property integer $estado
 *
 * @property EntregaPremio[] $entregaPremios
 * @property EntregaPremioRanking[] $entregaPremioRankings
 * @property PremioRanking[] $premioRankings
 * @property Pedido[] $pedidos
 * @property PuntajeAnual[] $puntajeAnuals
 * @property RankingAnual[] $rankingAnualAnios
 * @property PuntajeCampana[] $puntajeCampanas
 * @property Campana[] $campanas
 */
class InterlocutorComercial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interlocutor_comercial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zona_id', 'roles_id'], 'required'],
            [['zona_id', 'roles_id', 'estado'], 'integer'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre', 'apellido', 'email'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zona_id' => 'Zona ID',
            'roles_id' => 'Roles ID',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'email' => 'Email',
            'telefono' => 'Telefono',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntregaPremios()
    {
        return $this->hasMany(EntregaPremio::className(), ['interlocutor_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntregaPremioRankings()
    {
        return $this->hasMany(EntregaPremioRanking::className(), ['interlocutor_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPremioRankings()
    {
        return $this->hasMany(PremioRanking::className(), ['id' => 'premio_ranking_id'])->viaTable('entrega_premio_ranking', ['interlocutor_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['interlocutor_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntajeAnuals()
    {
        return $this->hasMany(PuntajeAnual::className(), ['interlocutor_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankingAnualAnios()
    {
        return $this->hasMany(RankingAnual::className(), ['anio' => 'ranking_anual_anio'])->viaTable('puntaje_anual', ['interlocutor_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntajeCampanas()
    {
        return $this->hasMany(PuntajeCampana::className(), ['interlocutor_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanas()
    {
        return $this->hasMany(Campana::className(), ['id' => 'campana_id'])->viaTable('puntaje_campana', ['interlocutor_comercial_id' => 'id']);
    }
}
