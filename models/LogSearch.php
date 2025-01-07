<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Log;

/**
 * LogSearch represents the model behind the search form of `app\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'conexion_id', 'user_id', 'codigo','tipo_id'], 'integer'],
            [['peticion', 'respuesta', 'created_at','nombre'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
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
    public function search($params): ActiveDataProvider
    {
        $query = Log::find()->alias('l');
        $query->addSelect("l.*,cn.tipo_id,cn.nombre");
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
        $query->leftJoin('conexion cn', 'cn.id = l.conexion_id');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'conexion_id' => $this->conexion_id,
            'user_id' => $this->user_id,
            'codigo' => $this->codigo,
            'created_at' => $this->created_at,
        ]);

        if(!empty($this->tipo_id)){
         $query->andFilterWhere(['cn.tipo_id' => $this->tipo_id]);
        }

        if(!empty($this->nombre)){
            $query->andFilterWhere(['like','cn.nombre', $this->nombre]);
        }

        $query->andFilterWhere(['like', 'peticion', $this->peticion])
            ->andFilterWhere(['like', 'respuesta', $this->respuesta]);

        return $dataProvider;
    }
}
