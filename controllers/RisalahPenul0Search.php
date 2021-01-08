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
            [['id', 'seri_brg', 'pfpd', 'kasi', 'kabid'], 'integer'],
            [['noagenda', 'nd', 'nd_tgl', 'rha', 'rha_tgl', 'perusahaan', 'pib', 'tglpib', 'fpkeputusan_NPP','keputusan_npp' ,'fpket_NPP', 'npp', 'npp_tgl', 'st', 'st_tgl', 'nhpu', 'nhpu_tgl', 'spktnp', 'spktnp_tgl', 'spktnp_jthtempo', 'sspcp', 'sspcp_tgl', 'ntb', 'ntpn', 'status_akhir_banding', 'analis', 'ket_risalah'], 'safe'],
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
            'npp_tgl' => $this->npp_tgl,
            'st_tgl' => $this->st_tgl,
            'pfpd' => $this->pfpd,
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
            'kasi' => $this->kasi,
            'kabid' => $this->kabid,
        ]);

        $query->andFilterWhere(['like', 'noagenda', $this->noagenda])
            ->andFilterWhere(['like', 'nd', $this->nd])
            ->andFilterWhere(['like', 'rha', $this->rha])
            ->andFilterWhere(['like', 'perusahaan', $this->perusahaan])
            ->andFilterWhere(['like', 'pib', $this->pib])
            ->andFilterWhere(['like', 'fpkeputusan_NPP', $this->fpkeputusan_NPP])
            ->andFilterWhere(['like', 'keputusan_npp', $this->keputusan_npp])
            ->andFilterWhere(['like', 'fpket_NPP', $this->fpket_NPP])
            ->andFilterWhere(['like', 'npp', $this->npp])
            ->andFilterWhere(['like', 'st', $this->st])
            ->andFilterWhere(['like', 'nhpu', $this->nhpu])
            ->andFilterWhere(['like', 'spktnp', $this->spktnp])
            ->andFilterWhere(['like', 'sspcp', $this->sspcp])
            ->andFilterWhere(['like', 'ntb', $this->ntb])
            ->andFilterWhere(['like', 'ntpn', $this->ntpn])
            ->andFilterWhere(['like', 'status_akhir_banding', $this->status_akhir_banding])
            ->andFilterWhere(['like', 'analis', $this->analis]);

        return $dataProvider;
    }
}
