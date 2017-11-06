<?php

namespace app\models\supply;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\supply\Supply;

/**
 * SupplySearch represents the model behind the search form about `app\models\supply\Supply`.
 */
class SupplySearch extends Supply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idInsumo', 'stock', 'activo'], 'integer'],
            [['nombre', 'descripcion', 'TIPO_TAREA_idTipoTarea'], 'safe'],
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
        $query = Supply::find();

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
            'idInsumo' => $this->idInsumo,
            'stock' => $this->stock,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'TIPO_TAREA_idTipoTarea', $this->TIPO_TAREA_idTipoTarea]);

        return $dataProvider;
    }
}
