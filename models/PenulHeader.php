<?php

namespace app\models;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "penul_header".
 *
 * @property int $id
 * @property string|null $noagenda
 * @property int $jen_dok
 * @property int $jen_pelanggaran
 * @property string|null $analisa_prosedur_rha 
 * @property int|null $kesimpulan_rha_jum_pt
 * @property float|null $kesimpulan_rha_nilaipotensi
 * @property string|null $laop 
 * @property string|null $laop_tgl 
 * @property string|null $kesimpulan_laop
 * @property int $penyaji_data1
 * @property int|null $penyaji_data2
 * @property int $analis1
 * @property int|null $analis2
 * @property int|null $analis3
 * @property int|null $pfpd
 * @property int|null $kasi
 * @property int|null $kabid
 * @property string|null $nd
 * @property string|null $nd_tgl
 * @property string|null $rha
 * @property string|null $rha_tgl
 * @property string|null $kkp 
 * @property string|null $kkp_tgl
 * @property string|null $npp
 * @property string|null $npp_tgl
 * @property string|null $st
 * @property string|null $st_tgl
 * @property string|null $nhpu
 * @property string|null $nhpu_tgl
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $keputusan_npp
 * @property PenulAnalisPenyaji $analis10
 * @property PenulAnalisPenyaji $analis20
 * @property PenulAnalisPenyaji $analis30
 * @property JenDok $jenDok
 * @property JenPelanggaran $jenPelanggaran
 * @property PenulDatatransaks[] $penulDatatransaks
 * @property PenulUraianAnalisa[] $penulUraianAnalisas
 * @property PenulAnalisPenyaji $penyajiData1
 * @property PenulAnalisPenyaji $penyajiData2
 * @property string|null $datagambar_filename
 */
class PenulHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_header';
    }


    public function behaviors()
{
    return [
        BlameableBehavior::className(),
        TimestampBehavior::className(),
    ];
}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jen_dok', 'jen_pelanggaran', 'penyaji_data1', 'analis1'], 'required'],
            [['jen_dok', 'jen_pelanggaran', 'kesimpulan_rha_jum_pt', 'penyaji_data1', 'penyaji_data2', 'analis1', 'analis2', 'analis3', 'pfpd','kasi' ,'kabid' , 'created_by', 'updated_by'], 'integer'],
            [['kesimpulan_rha_nilaipotensi'], 'number'],
            [['laop_tgl','kkp_tgl','nd_tgl', 'keputusan_npp', 'rha_tgl', 'npp_tgl', 'st_tgl', 'nhpu_tgl', 'created_at', 'updated_at'], 'safe'],
            [['noagenda'], 'string', 'max' => 25],
            [['analisa_prosedur_rha', 'analisa_prosedur_rha2','analisa_prosedur_rha3','analisa_prosedur_rha4','analisa_prosedur_rha5',
            'analisa_prosedur_rha6','analisa_prosedur_rha7'], 'string'], 
            [['kesimpulan_laop'], 'string', 'max' => 255],
            [['datagambar_filename'], 'string', 'max' => 100],
            [['laop','st' ,'nd', 'rha', 'kkp', 'npp', 'nhpu'], 'string', 'max' => 30],
            [['jen_dok'], 'exist', 'skipOnError' => true, 'targetClass' => JenDok::className(), 'targetAttribute' => ['jen_dok' => 'id']],
            [['jen_pelanggaran'], 'exist', 'skipOnError' => true, 'targetClass' => JenPelanggaran::className(), 'targetAttribute' => ['jen_pelanggaran' => 'id']],
            [['analis1'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['analis1' => 'id']],
            [['analis2'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['analis2' => 'id']],
            [['analis3'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['analis3' => 'id']],
            [['penyaji_data1'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['penyaji_data1' => 'id']],
            [['penyaji_data2'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['penyaji_data2' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noagenda' => 'Noagenda',
            'jen_dok' => 'Jen Dok',
            'jen_pelanggaran' => 'Jen Pelanggaran',
            'analisa_prosedur_rha' => 'Analisa Prosedur Rha', 
            'kesimpulan_rha_jum_pt' => 'Kesimpulan Rha Jum Pt',
            'kesimpulan_rha_nilaipotensi' => 'Kesimpulan Rha Nilaipotensi',
            'kesimpulan_laop' => 'Kesimpulan Laop',
            'penyaji_data1' => 'Penyaji Data1',
            'penyaji_data2' => 'Penyaji Data2',
            'analis1' => 'Analis1',
            'analis2' => 'Analis2',
            'analis3' => 'Analis3',
            'nd' => 'Nd',
            'nd_tgl' => 'Nd Tgl',
            'rha' => 'Rha',
            'rha_tgl' => 'Rha Tgl',
            'kkp' => 'KKP',
            'kkp_tgl' => 'KKp Tgl',
            'laop' => 'Laop',
            'laop_tgl' => 'Laop Tgl',
            'keputusan_npp' => 'Keputusan Npp',
            'npp' => 'Npp',
            'npp_tgl' => 'Npp Tgl',
            'st' => 'St',
            'st_tgl' => 'St Tgl',
            'nhpu' => 'Nhpu',
            'nhpu_tgl' => 'Nhpu Tgl',
            'datagambar_filename' => 'Data Gambar Filename',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Analis10]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getAnalis10()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'analis1']);
    }

    /**
     * Gets query for [[Analis20]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getAnalis20()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'analis2']);
    }

    /**
     * Gets query for [[Analis30]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getAnalis30()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'analis3']);
    }

    /**
     * Gets query for [[JenDok]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getJenDok()
    {
        return $this->hasOne(JenDok::className(), ['id' => 'jen_dok']);
    }

    /**
     * Gets query for [[JenPelanggaran]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getJenPelanggaran()
    {
        return $this->hasOne(JenPelanggaran::className(), ['id' => 'jen_pelanggaran']);
    }

    /**
     * Gets query for [[PenulDatatransaks]].
     *
     * @return \yii\db\ActiveQuery|PenulDatatransaksQuery
     */
    public function getPenulDatatransaks()
    {
        return $this->hasMany(PenulDatatransaks::className(), ['link_header' => 'id']);
    }

    /**
     * Gets query for [[PenulUraianAnalisas]].
     *
     * @return \yii\db\ActiveQuery|PenulUraianAnalisaQuery
     */
    public function getPenulUraianAnalisas()
    {
        return $this->hasMany(PenulUraianAnalisa::className(), ['link_header2' => 'id']);
    }

    /**
     * Gets query for [[PenyajiData1]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPenyajiData1()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'penyaji_data1']);
    }


    public function getPenyajiData1Name(){
        $model=$this->penyajiData1;
        return $model?$model->name:'';
    }

    /**
     * Gets query for [[PenyajiData2]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPenyajiData2()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'penyaji_data2']);
    }




      public function getPfpd()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'pfpd']);
    }
      public function getKasi()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'kasi']);
    }
      public function getKabid()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'kabid']);
    }

    /**
     * {@inheritdoc}
     * @return PenulHeaderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulHeaderQuery(get_called_class());
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
