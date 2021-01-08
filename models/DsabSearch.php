<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dsab;

/**
 * DsabSearch represents the model behind the search form of `app\models\Dsab`.
 */
class DsabSearch extends Dsab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['tim_secondment', 'nama_wp', 'npwp', 'kpp', 'kanwil', 'dsab_nondsab', 'status', 'rencana_tindaklanjut', 'gappotensi_dan_realisasi', 'hal_yg_perlu_dieskalasi', 'keterangan', 'status_pemeriksaan', 'follow_up', 'created_at', 'updated_at'], 'safe'],
            [['earlycalculation_sekber', 'nilai_potensi', 'realisasi'], 'number'],
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
        $query = Dsab::find();

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
            'earlycalculation_sekber' => $this->earlycalculation_sekber,
            'nilai_potensi' => $this->nilai_potensi,
            'realisasi' => $this->realisasi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'tim_secondment', $this->tim_secondment])
            ->andFilterWhere(['like', 'nama_wp', $this->nama_wp])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'kpp', $this->kpp])
            ->andFilterWhere(['like', 'kanwil', $this->kanwil])
            ->andFilterWhere(['like', 'dsab_nondsab', $this->dsab_nondsab])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'rencana_tindaklanjut', $this->rencana_tindaklanjut])
            ->andFilterWhere(['like', 'gappotensi_dan_realisasi', $this->gappotensi_dan_realisasi])
            ->andFilterWhere(['like', 'hal_yg_perlu_dieskalasi', $this->hal_yg_perlu_dieskalasi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status_pemeriksaan', $this->status_pemeriksaan])
            ->andFilterWhere(['like', 'follow_up', $this->follow_up]);

        return $dataProvider;
    }
}
