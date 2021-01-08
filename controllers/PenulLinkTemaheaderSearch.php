<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenulLinkTemaheader;

/**
 * PenulLinkTemaheaderSearch represents the model behind the search form of `app\models\PenulLinkTemaheader`.
 */
class PenulLinkTemaheaderSearch extends PenulLinkTemaheader
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'link_tema', 'link_header', 'link_upload_berkas', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['keyword_specific', 'dap_rha', 'dap_rha2', 'dap_rha3', 'dap_rha4', 'dap_rha5', 'dap_rha6', 'dap_rha7', 'data_pib', 'data_gambar', 'data_gambar_filename', 'data_pib_filename', 'periode_tarik_data', 'ket'], 'safe'],
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
        $query = PenulLinkTemaheader::find();

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
            'link_tema' => $this->link_tema,
            'link_header' => $this->link_header,
            'periode_tarik_data' => $this->periode_tarik_data,
            'link_upload_berkas' => $this->link_upload_berkas,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'keyword_specific', $this->keyword_specific])
            ->andFilterWhere(['like', 'dap_rha', $this->dap_rha])
            ->andFilterWhere(['like', 'dap_rha2', $this->dap_rha2])
            ->andFilterWhere(['like', 'dap_rha3', $this->dap_rha3])
            ->andFilterWhere(['like', 'dap_rha4', $this->dap_rha4])
            ->andFilterWhere(['like', 'dap_rha5', $this->dap_rha5])
            ->andFilterWhere(['like', 'dap_rha6', $this->dap_rha6])
            ->andFilterWhere(['like', 'dap_rha7', $this->dap_rha7])
            ->andFilterWhere(['like', 'data_pib', $this->data_pib])
            ->andFilterWhere(['like', 'data_gambar', $this->data_gambar])
            ->andFilterWhere(['like', 'data_gambar_filename', $this->data_gambar_filename])
            ->andFilterWhere(['like', 'data_pib_filename', $this->data_pib_filename])
            ->andFilterWhere(['like', 'ket', $this->ket]);

        return $dataProvider;
    }
}
