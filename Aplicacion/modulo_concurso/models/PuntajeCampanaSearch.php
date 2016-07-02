<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PuntajeCampana;

/**
 * PuntajeCampanaSearch represents the model behind the search form about `app\models\PuntajeCampana`.
 */
class PuntajeCampanaSearch extends PuntajeCampana
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campana_id', 'interlocutor_comercial_id', 'puntaje_actual', 'puntaje_acumulado'], 'integer'],
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
        $query = PuntajeCampana::find();

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
            'campana_id' => $this->campana_id,
            'interlocutor_comercial_id' => $this->interlocutor_comercial_id,
            'puntaje_actual' => $this->puntaje_actual,
            'puntaje_acumulado' => $this->puntaje_acumulado,
        ]);

        return $dataProvider;
    }
}
