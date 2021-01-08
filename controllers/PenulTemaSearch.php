<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenulTema;

/**
 * PenulTemaSearch represents the model behind the search form of `app\models\PenulTema`.
 */
class PenulTemaSearch extends PenulTema
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['tema', 'key_word', 'hs_awal', 'hs_akhir', 'cara_tarik_datanya', 'analisa', 'referensi', 'hint_1', 'hint_2', 'hint_3', 'periode'], 'safe'],
            [['tarif_akhir'], 'number'],
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
        $query = PenulTema::find();

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
            'tarif_akhir' => $this->tarif_akhir,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tema', $this->tema])
            ->andFilterWhere(['like', 'key_word', $this->key_word])
            ->andFilterWhere(['like', 'hs_awal', $this->hs_awal])
            ->andFilterWhere(['like', 'hs_akhir', $this->hs_akhir])
            ->andFilterWhere(['like', 'cara_tarik_datanya', $this->cara_tarik_datanya])
            ->andFilterWhere(['like', 'analisa', $this->analisa])
            ->andFilterWhere(['like', 'referensi', $this->referensi])
            ->andFilterWhere(['like', 'hint_1', $this->hint_1])
            ->andFilterWhere(['like', 'hint_2', $this->hint_2])
            ->andFilterWhere(['like', 'hint_3', $this->hint_3])
            ->andFilterWhere(['like', 'periode', $this->periode]);

        return $dataProvider;
    }
}
