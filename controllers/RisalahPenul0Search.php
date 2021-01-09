<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RisalahPenul0;

/**
 * RisalahPenul0Search represents the model behind the search form of `app\models\RisalahPenul0`.
 */
class RisalahPenul0Search extends RisalahPenul0
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seri_brg'], 'integer'],
            [['noagenda', 'nd', 'nd_tgl', 'rha', 'rha_tgl', 'perusahaan', 'pib', 'tglpib', 'keputusan_npp', 'fpkeputusan_NPP', 'fpket_NPP', 'laop', 'laop_tgl', 'kkp', 'kkp_tgl', 'npp', 'npp_tgl', 'st', 'st_tgl', 'pfpd', 'nhpu', 'nhpu_tgl', 'spktnp', 'spktnp_tgl', 'spktnp_jthtempo', 'sspcp', 'sspcp_tgl', 'ntb', 'ntpn', 'status_akhir_banding', 'npp_rha_gab_1npp', 'npp_tgl_rha_gab_1npp', 'st_rha_gab_1npp', 'st_tgl_rha_gab_1npp', 'nhpu_rha_gab_1npp', 'nhpu_tgl_rha_gab_1npp', 'kasi', 'kabid', 'analis1', 'analis2', 'analis3', 'penyaji_data1', 'ket_risalah'], 'safe'],
            [['bm', 'bmad', 'bmi', 'bmdp', 'ppn', 'pph', 'denda', 'total_tagihan'], 'number'],
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
        $query = RisalahPenul0::find();

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
            'nd_tgl' => $this->nd_tgl,
            'rha_tgl' => $this->rha_tgl,
            'tglpib' => $this->tglpib,
            'seri_brg' => $this->seri_brg,
            'laop_tgl' => $this->laop_tgl,
            'kkp_tgl' => $this->kkp_tgl,
            'npp_tgl' => $this->npp_tgl,
            'st_tgl' => $this->st_tgl,
            'nhpu_tgl' => $this->nhpu_tgl,
            'spktnp_tgl' => $this->spktnp_tgl,
            'bm' => $this->bm,
            'bmad' => $this->bmad,
            'bmi' => $this->bmi,
            'bmdp' => $this->bmdp,
            'ppn' => $this->ppn,
            'pph' => $this->pph,
            'denda' => $this->denda,
            'total_tagihan' => $this->total_tagihan,
            'spktnp_jthtempo' => $this->spktnp_jthtempo,
            'sspcp_tgl' => $this->sspcp_tgl,
            'npp_tgl_rha_gab_1npp' => $this->npp_tgl_rha_gab_1npp,
            'st_tgl_rha_gab_1npp' => $this->st_tgl_rha_gab_1npp,
            'nhpu_tgl_rha_gab_1npp' => $this->nhpu_tgl_rha_gab_1npp,
        ]);

        $query->andFilterWhere(['like', 'noagenda', $this->noagenda])
            ->andFilterWhere(['like', 'nd', $this->nd])
            ->andFilterWhere(['like', 'rha', $this->rha])
            ->andFilterWhere(['like', 'perusahaan', $this->perusahaan])
            ->andFilterWhere(['like', 'pib', $this->pib])
            ->andFilterWhere(['like', 'keputusan_npp', $this->keputusan_npp])
            ->andFilterWhere(['like', 'fpkeputusan_NPP', $this->fpkeputusan_NPP])
            ->andFilterWhere(['like', 'fpket_NPP', $this->fpket_NPP])
            ->andFilterWhere(['like', 'laop', $this->laop])
            ->andFilterWhere(['like', 'kkp', $this->kkp])
            ->andFilterWhere(['like', 'npp', $this->npp])
            ->andFilterWhere(['like', 'st', $this->st])
            ->andFilterWhere(['like', 'pfpd', $this->pfpd])
            ->andFilterWhere(['like', 'nhpu', $this->nhpu])
            ->andFilterWhere(['like', 'spktnp', $this->spktnp])
            ->andFilterWhere(['like', 'sspcp', $this->sspcp])
            ->andFilterWhere(['like', 'ntb', $this->ntb])
            ->andFilterWhere(['like', 'ntpn', $this->ntpn])
            ->andFilterWhere(['like', 'status_akhir_banding', $this->status_akhir_banding])
            ->andFilterWhere(['like', 'npp_rha_gab_1npp', $this->npp_rha_gab_1npp])
            ->andFilterWhere(['like', 'st_rha_gab_1npp', $this->st_rha_gab_1npp])
            ->andFilterWhere(['like', 'nhpu_rha_gab_1npp', $this->nhpu_rha_gab_1npp])
            ->andFilterWhere(['like', 'kasi', $this->kasi])
            ->andFilterWhere(['like', 'kabid', $this->kabid])
            ->andFilterWhere(['like', 'analis1', $this->analis1])
            ->andFilterWhere(['like', 'analis2', $this->analis2])
            ->andFilterWhere(['like', 'analis3', $this->analis3])
            ->andFilterWhere(['like', 'penyaji_data1', $this->penyaji_data1])
            ->andFilterWhere(['like', 'ket_risalah', $this->ket_risalah]);

        return $dataProvider;
    }
}
