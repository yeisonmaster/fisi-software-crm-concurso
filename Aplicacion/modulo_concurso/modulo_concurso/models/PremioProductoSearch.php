<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PremioProducto;

/**
 * PremioProductoSearch represents the model behind the search form about `app\models\PremioProducto`.
 */
class PremioProductoSearch extends PremioProducto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'campana_id', 'producto_id', 'estado', 'puntaje_con_caje', 'puntaje_sin_canje'], 'integer'],
            [['nombre'], 'safe'],
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
        $query = PremioProducto::find();

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
            'id' => $this->id,
            'campana_id' => $this->campana_id,
            'producto_id' => $this->producto_id,
            'estado' => $this->estado,
            'puntaje_con_caje' => $this->puntaje_con_caje,
            'puntaje_sin_canje' => $this->puntaje_sin_canje,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
