<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntregaPremio;

/**
 * EntregaPremioSearch represents the model behind the search form about `app\models\EntregaPremio`.
 */
class EntregaPremioSearch extends EntregaPremio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['premio_producto_id', 'premio_tipo_id', 'interlocutor_comercial_id', 'campana_solicitud', 'campana_entrega'], 'integer'],
            [['fecha_solicitud', 'fecha_entrega'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EntregaPremio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'premio_producto_id' => $this->premio_producto_id,
            'premio_tipo_id' => $this->premio_tipo_id,
            'interlocutor_comercial_id' => $this->interlocutor_comercial_id,
            'campana_solicitud' => $this->campana_solicitud,
            'campana_entrega' => $this->campana_entrega,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_entrega' => $this->fecha_entrega,
        ]);

        return $dataProvider;
    }
}
