<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penul_datatransaks".
 *
 * @property int $id
 * @property int|null $link_header
 * @property string|null $flag_pusat
 * @property string|null $flag_pusat_ket
 * @property string|null $kode_kantor
 * @property string|null $pib
 * @property string|null $tglpib
 * @property int|null $seri_brg
 * @property string|null $npwp_imp
 * @property string|null $imp
 * @property string|null $uraian_brg
 * @property string|null $hs_t
 * @property float|null $trf_bm_t
 * @property float|null $trf_ppn_t
 * @property float|null $trf_pph_t
 * @property float|null $bm_t_nilai_akhir
 * @property string|null $hs
 * @property float|null $trf_bm
 * @property float|null $kurs
 * @property float|null $bm_nilai_awal
 * @property float|null $ppn_nilai_awal
 * @property float|null $ppn_t_nilai_akhir
 * @property float|null $pph_nilai_awal
 * @property float|null $pph_t_nilai_akhir
 * @property float|null $ppnbm_t_nilai_akhir
 * @property float|null $nilaipabean_awal
 * @property float|null $nilaipabean_akhir
 * @property float|null $denda
 * @property float|null $total_tagihan
 * @property string|null $ket
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property PenulHeader $linkHeader
 */
class PenulDatatransaks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_datatransaks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_header', 'seri_brg', 'created_by', 'updated_by'], 'integer'],
            [['flag_pusat'], 'string'],
            [['tglpib', 'created_at', 'updated_at'], 'safe'],
            [['trf_bm_t', 'bm_t_nilai_akhir', 'trf_bm', 'trf_ppn_t','trf_pph_t','kurs', 'bm_nilai_awal', 'ppn_nilai_awal', 'ppn_t_nilai_akhir', 'pph_nilai_awal', 'pph_t_nilai_akhir', 'ppnbm_t_nilai_akhir', 'nilaipabean_awal', 'nilaipabean_akhir', 'denda', 'total_tagihan'], 'number'],
            [['flag_pusat_ket'], 'string', 'max' => 20],
            [['kode_kantor', 'pib'], 'string', 'max' => 6],
            [['npwp_imp'], 'string', 'max' => 16],
            [['imp'], 'string', 'max' => 50],
            [['uraian_brg'], 'string', 'max' => 254],
            [['hs_t', 'hs'], 'string', 'max' => 15],
            [['ket'], 'string', 'max' => 255],
            [['link_header'], 'exist', 'skipOnError' => true, 'targetClass' => PenulHeader::className(), 'targetAttribute' => ['link_header' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_header' => 'Link Header',
            'flag_pusat' => 'Flag Pusat',
            'flag_pusat_ket' => 'Flag Pusat Ket',
            'kode_kantor' => 'Kode Kantor',
            'pib' => 'Pib',
            'tglpib' => 'Tglpib',
            'seri_brg' => 'Seri Brg',
            'npwp_imp' => 'Npwp Imp',
            'imp' => 'Imp',
            'uraian_brg' => 'Uraian Brg',
            'hs_t' => 'Hs T',
            'trf_bm_t' => 'Trf Bm T',
            'trf_ppn_t' => 'Trf PPN T',
            'trf_pph_t' => 'Trf PPh T',
            'bm_t_nilai_akhir' => 'Bm T Nilai Akhir',
            'hs' => 'Hs',
            'trf_bm' => 'Trf Bm',
            'kurs' => 'Kurs',
            'bm_nilai_awal' => 'Bm Nilai Awal',
            'ppn_nilai_awal' => 'Ppn Nilai Awal',
            'ppn_t_nilai_akhir' => 'Ppn T Nilai Akhir',
            'pph_nilai_awal' => 'Pph Nilai Awal',
            'pph_t_nilai_akhir' => 'Pph T Nilai Akhir',
            'ppnbm_t_nilai_akhir' => 'Ppnbm T Nilai Akhir',
            'nilaipabean_awal' => 'Nilaipabean Awal',
            'nilaipabean_akhir' => 'Nilaipabean Akhir',
            'denda' => 'Denda',
            'total_tagihan' => 'Total Tagihan',
            'ket' => 'Ket',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[LinkHeader]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
    public function getLinkHeader()
    {
        return $this->hasOne(PenulHeader::className(), ['id' => 'link_header']);
    }

    /**
     * {@inheritdoc}
     * @return PenulDatatransaksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulDatatransaksQuery(get_called_class());
    }
}
