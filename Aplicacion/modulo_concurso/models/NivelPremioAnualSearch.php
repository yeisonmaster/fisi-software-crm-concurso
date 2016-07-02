<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NivelPremioAnual;

/**
 * NivelPremioAnualSearch represents the model behind the search form about `app\models\NivelPremioAnual`.
 */
class NivelPremioAnualSearch extends NivelPremioAnual
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ranking_anual_anio', 'nivel_ranking_id', 'puntaje_minimo', 'puntaje_hasta'], 'integer'],
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
        $query = NivelPremioAnual::find();

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
            'ranking_anual_anio' => $this->ranking_anual_anio,
            'nivel_ranking_id' => $this->nivel_ranking_id,
            'puntaje_minimo' => $this->puntaje_minimo,
            'puntaje_hasta' => $this->puntaje_hasta,
        ]);

        return $dataProvider;
    }
}
