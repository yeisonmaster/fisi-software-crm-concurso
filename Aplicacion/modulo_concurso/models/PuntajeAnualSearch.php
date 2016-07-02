<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PuntajeAnual;

/**
 * PuntajeAnualSearch represents the model behind the search form about `app\models\PuntajeAnual`.
 */
class PuntajeAnualSearch extends PuntajeAnual
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ranking_anual_anio', 'interlocutor_comercial_id'], 'integer'],
            [['puntaje_acumulado'], 'safe'],
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
        $query = PuntajeAnual::find();

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
            'interlocutor_comercial_id' => $this->interlocutor_comercial_id,
        ]);

        $query->andFilterWhere(['like', 'puntaje_acumulado', $this->puntaje_acumulado]);

        return $dataProvider;
    }
}
