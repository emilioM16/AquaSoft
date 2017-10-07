<?php

namespace app\models\aquarium;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\aquarium\Aquarium;

/**
 * AquariumSearch represents the model behind the search form about `app\models\Aquarium`.
 */
class AquariumSearch extends Aquarium
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAcuario', 'espacioDisponible', 'activo'], 'integer'],
            [['nombre', 'descripcion'], 'safe'],
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
        $query = Aquarium::find();

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
            'idAcuario' => $this->idAcuario,
            'espacioDisponible' => $this->espacioDisponible,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
