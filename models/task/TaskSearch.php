<?php

namespace app\models\task;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\task\Task;

/**
 * TaskSearch represents the model behind the search form about `app\models\task\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTarea', 'PLANIFICACION_idPlanificacion', 'USUARIO_idUsuario', 'ACUARIO_idAcuario'], 'integer'],
            [['titulo', 'descripcion', 'fechaHoraInicio', 'fechaHoraFin', 'fechaHoraRealizacion', 'TIPO_TAREA_idTipoTarea'], 'safe'],
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
        $query = Task::find();

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
            'idTarea' => $this->idTarea,
            'fechaHoraInicio' => $this->fechaHoraInicio,
            'fechaHoraFin' => $this->fechaHoraFin,
            'fechaHoraRealizacion' => $this->fechaHoraRealizacion,
            'PLANIFICACION_idPlanificacion' => $this->PLANIFICACION_idPlanificacion,
            'USUARIO_idUsuario' => $this->USUARIO_idUsuario,
            'ACUARIO_idAcuario' => $this->ACUARIO_idAcuario,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'TIPO_TAREA_idTipoTarea', $this->TIPO_TAREA_idTipoTarea]);

        return $dataProvider;
    }
}
