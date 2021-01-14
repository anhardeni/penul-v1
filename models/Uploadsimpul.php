<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uploadsimpul".
 *
 * @property int $id
 * @property string|null $KD_KANTOR
 * @property string|null $NO_DOK
 * @property string|null $TGL_DOK
 * @property string|null $NPWP
 * @property string|null $NM_PERUSAHAAN
 * @property int|null $SERI_BRG
 * @property string|null $UR_BRG
 * @property string|null $HS_AWAL
 * @property string|null $HS_AKHIR
 * @property float|null $NILAI_AWAL
 * @property float|null $NILAI_AKHIR
 * @property float|null $TRF_BEA_AWAL
 * @property float|null $TRF_BEA_AKHIR
 * @property float|null $TRF_PPN_AWAL
 * @property float|null $TRF_PPN_AKHIR
 * @property float|null $TRF_PPH_AWAL
 * @property float|null $TRF_PPH_AKHIR
 * @property float|null $TRF_PPNBM_AWAL
 * @property float|null $TRF_PPNBM_AKHIR
 * @property float|null $TRF_BMAD_AWAL
 * @property float|null $TRF_BMAD_AKHIR
 * @property string|null $UR_KET_RHA Penetapan Hs code 2
 * @property float|null $POTENSI_BEA
 * @property float|null $POTENSI_BMAD
 * @property float|null $POTENSI_PPN
 * @property float|null $POTENSI_PPH
 * @property float|null $POTENSI_PPNBM
 * @property float|null $POTENSI_DENDA
 * @property float|null $TOTAL_POTENSI
 * @property string|null $KET_POTENSI
 */
class Uploadsimpul extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function primaryKey() 
           { 
               return ['id']; 
           } 


    public static function tableName()
    {
        return 'uploadsimpul';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'SERI_BRG'], 'integer'],
            [['TGL_DOK'], 'safe'],
            [['NILAI_AWAL', 'NILAI_AKHIR', 'TRF_BEA_AWAL', 'TRF_BEA_AKHIR', 'TRF_PPN_AWAL', 'TRF_PPN_AKHIR', 'TRF_PPH_AWAL', 'TRF_PPH_AKHIR', 'TRF_PPNBM_AWAL', 'TRF_PPNBM_AKHIR', 'TRF_BMAD_AWAL', 'TRF_BMAD_AKHIR', 'POTENSI_BEA', 'POTENSI_BMAD', 'POTENSI_PPN', 'POTENSI_PPH', 'POTENSI_PPNBM', 'POTENSI_DENDA', 'TOTAL_POTENSI'], 'number'],
            [['UR_KET_RHA'], 'string'],
            [['KD_KANTOR', 'NO_DOK'], 'string', 'max' => 6],
            [['NPWP'], 'string', 'max' => 30],
            [['NM_PERUSAHAAN'], 'string', 'max' => 50],
            [['UR_BRG'], 'string', 'max' => 254],
            [['HS_AWAL', 'HS_AKHIR'], 'string', 'max' => 15],
            [['KET_POTENSI'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'KD_KANTOR' => 'Kd Kantor',
            'NO_DOK' => 'No Dok',
            'TGL_DOK' => 'Tgl Dok',
            'NPWP' => 'Npwp',
            'NM_PERUSAHAAN' => 'Nm Perusahaan',
            'SERI_BRG' => 'Seri Brg',
            'UR_BRG' => 'Ur Brg',
            'HS_AWAL' => 'Hs Awal',
            'HS_AKHIR' => 'Hs Akhir',
            'NILAI_AWAL' => 'Nilai Awal',
            'NILAI_AKHIR' => 'Nilai Akhir',
            'TRF_BEA_AWAL' => 'Trf Bea Awal',
            'TRF_BEA_AKHIR' => 'Trf Bea Akhir',
            'TRF_PPN_AWAL' => 'Trf Ppn Awal',
            'TRF_PPN_AKHIR' => 'Trf Ppn Akhir',
            'TRF_PPH_AWAL' => 'Trf Pph Awal',
            'TRF_PPH_AKHIR' => 'Trf Pph Akhir',
            'TRF_PPNBM_AWAL' => 'Trf Ppnbm Awal',
            'TRF_PPNBM_AKHIR' => 'Trf Ppnbm Akhir',
            'TRF_BMAD_AWAL' => 'Trf Bmad Awal',
            'TRF_BMAD_AKHIR' => 'Trf Bmad Akhir',
            'UR_KET_RHA' => 'Penetapan Hs code 2',
            'POTENSI_BEA' => 'Potensi Bea',
            'POTENSI_BMAD' => 'Potensi Bmad',
            'POTENSI_PPN' => 'Potensi Ppn',
            'POTENSI_PPH' => 'Potensi Pph',
            'POTENSI_PPNBM' => 'Potensi Ppnbm',
            'POTENSI_DENDA' => 'Potensi Denda',
            'TOTAL_POTENSI' => 'Total Potensi',
            'KET_POTENSI' => 'Ket Potensi',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UploadsimpulQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadsimpulQuery(get_called_class());
    }
}
