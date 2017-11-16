<?php

namespace app\models\planning;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\planning\Planning;

/**
 * PlanningSearch represents the model behind the search form about `app\models\planning\Planning`.
 */
class PlanningSearch extends Planning
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPlanificacion', 'activo', 'ACUARIO_USUARIO_acuario_idAcuario', 'ACUARIO_USUARIO_usuario_idUsuario'], 'integer'],
            [['titulo', 'anioMes', 'fechaHoraCreacion', 'ESTADO_PLANIFICACION_idEstadoPlanificacion'], 'safe'],
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
        $rol = Yii::$app->user->identity->getRole();
        if($rol == 'especialista'){
            $query = Planning::find()
                    ->where(['ACUARIO_USUARIO_usuario_idUsuario'=>Yii::$app->user->identity->idUsuario])
                    ->andWhere(['activo'=>1]);
        }else{
            $query = Planning::find()
                    ->andWhere(['activo'=>1]);
        }

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
            'idPlanificacion' => $this->idPlanificacion,
            'anioMes' => $this->anioMes,
            'fechaHoraCreacion' => $this->fechaHoraCreacion,
            'activo' => $this->activo,
            'activo' => 1,
            'ACUARIO_USUARIO_acuario_idAcuario' => $this->ACUARIO_USUARIO_acuario_idAcuario,
            'ACUARIO_USUARIO_usuario_idUsuario' => $this->ACUARIO_USUARIO_usuario_idUsuario,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'ESTADO_PLANIFICACION_idEstadoPlanificacion', $this->ESTADO_PLANIFICACION_idEstadoPlanificacion]);

        return $dataProvider;
    }
}
