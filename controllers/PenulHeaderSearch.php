<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenulHeader;

/**
 * PenulHeaderSearch represents the model behind the search form of `app\models\PenulHeader`.
 */
class PenulHeaderSearch extends PenulHeader
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jen_dok', 'jen_pelanggaran', 'kesimpulan_rha_jum_pt', 'penyaji_data1', 'penyaji_data2', 'analis1', 'analis2', 'analis3', 'created_by', 'updated_by'], 'integer'],
            [['noagenda', 'kesimpulan_laop', 'nd', 'nd_tgl', 'rha', 'rha_tgl', 'npp', 'npp_tgl', 'st', 'st_tgl', 'nhpu', 'nhpu_tgl', 'created_at', 'updated_at'], 'safe'],
            [['kesimpulan_rha_nilaipotensi'], 'number'],
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
        $query = PenulHeader::find();

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
            'jen_dok' => $this->jen_dok,
            'jen_pelanggaran' => $this->jen_pelanggaran,
            'kesimpulan_rha_jum_pt' => $this->kesimpulan_rha_jum_pt,
            'kesimpulan_rha_nilaipotensi' => $this->kesimpulan_rha_nilaipotensi,
            'penyaji_data1' => $this->penyaji_data1,
            'penyaji_data2' => $this->penyaji_data2,
            'analis1' => $this->analis1,
            'analis2' => $this->analis2,
            'analis3' => $this->analis3,
            'nd_tgl' => $this->nd_tgl,
            'rha_tgl' => $this->rha_tgl,
            'npp_tgl' => $this->npp_tgl,
            'st_tgl' => $this->st_tgl,
            'nhpu_tgl' => $this->nhpu_tgl,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'noagenda', $this->noagenda])
            ->andFilterWhere(['like', 'kesimpulan_laop', $this->kesimpulan_laop])
            ->andFilterWhere(['like', 'nd', $this->nd])
            ->andFilterWhere(['like', 'rha', $this->rha])
            ->andFilterWhere(['like', 'npp', $this->npp])
            ->andFilterWhere(['like', 'st', $this->st])
            ->andFilterWhere(['like', 'nhpu', $this->nhpu]);

        return $dataProvider;
    }
}
