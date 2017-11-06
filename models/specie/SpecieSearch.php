<?php

namespace app\models\specie;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\specie\Specie;

/**
 * SpecieSearch represents the model behind the search form about `app\models\specie\Specie`.
 */
class SpecieSearch extends Specie
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEspecie', 'minEspacio', 'activo'], 'integer'],
            [['nombre', 'descripcion'], 'safe'],
            [['minPH', 'maxPH', 'minTemp', 'maxTemp', 'minSalinidad', 'maxSalinidad', 'minLux', 'maxLux', 'minCO2', 'maxCO2'], 'number'],
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
        $query = Specie::find();

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
            'idEspecie' => $this->idEspecie,
            'minPH' => $this->minPH,
            'maxPH' => $this->maxPH,
            'minTemp' => $this->minTemp,
            'maxTemp' => $this->maxTemp,
            'minSalinidad' => $this->minSalinidad,
            'maxSalinidad' => $this->maxSalinidad,
            'minLux' => $this->minLux,
            'maxLux' => $this->maxLux,
            'minEspacio' => $this->minEspacio,
            'minCO2' => $this->minCO2,
            'maxCO2' => $this->maxCO2,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
