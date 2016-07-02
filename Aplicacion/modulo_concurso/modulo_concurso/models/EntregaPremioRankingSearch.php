<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntregaPremioRanking;

/**
 * EntregaPremioRankingSearch represents the model behind the search form about `app\models\EntregaPremioRanking`.
 */
class EntregaPremioRankingSearch extends EntregaPremioRanking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['interlocutor_comercial_id', 'premio_ranking_id'], 'integer'],
            [['fecha_entrega'], 'safe'],
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
        $query = EntregaPremioRanking::find();

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
            'interlocutor_comercial_id' => $this->interlocutor_comercial_id,
            'premio_ranking_id' => $this->premio_ranking_id,
            'fecha_entrega' => $this->fecha_entrega,
        ]);

        return $dataProvider;
    }
}
