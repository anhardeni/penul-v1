<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Uploadsimpul;

/**
 * UploadsimpulSearch represents the model behind the search form of `app\models\Uploadsimpul`.
 */
class UploadsimpulSearch extends Uploadsimpul
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'SERI_BRG'], 'integer'],
            [['KD_KANTOR', 'NO_DOK', 'TGL_DOK', 'NPWP', 'NM_PERUSAHAAN', 'UR_BRG', 'HS_AWAL', 'HS_AKHIR', 'UR_KET_RHA', 'KET_POTENSI'], 'safe'],
            [['NILAI_AWAL', 'NILAI_AKHIR', 'TRF_BEA_AWAL', 'TRF_BEA_AKHIR', 'TRF_PPN_AWAL', 'TRF_PPN_AKHIR', 'TRF_PPH_AWAL', 'TRF_PPH_AKHIR', 'TRF_PPNBM_AWAL', 'TRF_PPNBM_AKHIR', 'TRF_BMAD_AWAL', 'TRF_BMAD_AKHIR', 'POTENSI_BEA', 'POTENSI_BMAD', 'POTENSI_PPN', 'POTENSI_PPH', 'POTENSI_PPNBM', 'POTENSI_DENDA', 'TOTAL_POTENSI'], 'number'],
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
        $query = Uploadsimpul::find();

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
            'TGL_DOK' => $this->TGL_DOK,
            'SERI_BRG' => $this->SERI_BRG,
            'NILAI_AWAL' => $this->NILAI_AWAL,
            'NILAI_AKHIR' => $this->NILAI_AKHIR,
            'TRF_BEA_AWAL' => $this->TRF_BEA_AWAL,
            'TRF_BEA_AKHIR' => $this->TRF_BEA_AKHIR,
            'TRF_PPN_AWAL' => $this->TRF_PPN_AWAL,
            'TRF_PPN_AKHIR' => $this->TRF_PPN_AKHIR,
            'TRF_PPH_AWAL' => $this->TRF_PPH_AWAL,
            'TRF_PPH_AKHIR' => $this->TRF_PPH_AKHIR,
            'TRF_PPNBM_AWAL' => $this->TRF_PPNBM_AWAL,
            'TRF_PPNBM_AKHIR' => $this->TRF_PPNBM_AKHIR,
            'TRF_BMAD_AWAL' => $this->TRF_BMAD_AWAL,
            'TRF_BMAD_AKHIR' => $this->TRF_BMAD_AKHIR,
            'POTENSI_BEA' => $this->POTENSI_BEA,
            'POTENSI_BMAD' => $this->POTENSI_BMAD,
            'POTENSI_PPN' => $this->POTENSI_PPN,
            'POTENSI_PPH' => $this->POTENSI_PPH,
            'POTENSI_PPNBM' => $this->POTENSI_PPNBM,
            'POTENSI_DENDA' => $this->POTENSI_DENDA,
            'TOTAL_POTENSI' => $this->TOTAL_POTENSI,
        ]);

        $query->andFilterWhere(['like', 'KD_KANTOR', $this->KD_KANTOR])
            ->andFilterWhere(['like', 'NO_DOK', $this->NO_DOK])
            ->andFilterWhere(['like', 'NPWP', $this->NPWP])
            ->andFilterWhere(['like', 'NM_PERUSAHAAN', $this->NM_PERUSAHAAN])
            ->andFilterWhere(['like', 'UR_BRG', $this->UR_BRG])
            ->andFilterWhere(['like', 'HS_AWAL', $this->HS_AWAL])
            ->andFilterWhere(['like', 'HS_AKHIR', $this->HS_AKHIR])
            ->andFilterWhere(['like', 'UR_KET_RHA', $this->UR_KET_RHA])
            ->andFilterWhere(['like', 'KET_POTENSI', $this->KET_POTENSI]);

        return $dataProvider;
    }
}
