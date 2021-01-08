<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Uploadsibndi;

/**
 * app\models\UploadsibndiSearch represents the model behind the search form about `app\models\Uploadsibndi`.
 */
 class UploadsibndiSearch extends Uploadsibndi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_berkas', 'no_dok', 'fkidmohon', 'created_by'], 'integer'],
            [['tgl_dok', 'src_filename', 'web_filename', 'created_at', 'updated_at'], 'safe'],
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
        $query = Uploadsibndi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_berkas' => $this->id_berkas,
            'no_dok' => $this->no_dok,
            'tgl_dok' => $this->tgl_dok,
            'fkidmohon' => $this->fkidmohon,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'src_filename', $this->src_filename])
            ->andFilterWhere(['like', 'web_filename', $this->web_filename]);

        return $dataProvider;
    }
}
