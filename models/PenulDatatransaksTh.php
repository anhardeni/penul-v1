<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penul_datatransaks_th".
 *
 * @property int $id
 * @property int|null $link_header_th
 * @property string|null $flag_pusat
 * @property string|null $flag_pusat_ket
 * @property string|null $kode_kantor
 * @property string|null $pib
 * @property string|null $tglpib
 * @property int|null $seri_brg
 * @property int|null $kdskepfas
 * @property string|null $npwp_imp
 * @property string|null $imp
 * @property string|null $uraian_brg
 * @property string|null $hs
 * @property float|null $trf_bm
 * @property float|null $bm_nilai_awal
 * @property string|null $hs_t
 * @property float|null $trf_bm_t
 * @property float|null $bm_t_nilai_akhir
 * @property float|null $bmbbs_nilai_akhir
 * @property float|null $bmad_nilai_akhir
 * @property float|null $bmdp_nilai_akhir
 * @property float|null $kurs
 * @property float|null $ppn_nilai_awal
 * @property float|null $ppn_t_nilai_akhir
 * @property float|null $ppnbbs_nilai_akhir
 * @property float|null $ppntdp_nilai_akhir
 * @property float|null $pph_nilai_awal
 * @property float|null $pph_t_nilai_akhir
 * @property float|null $pphbbs_nilai_akhir
 * @property float|null $pphdp_nilai_akhir
 * @property float|null $ppnbm_t_nilai_akhir
 * @property float|null $nilaipabean_awal
 * @property float|null $nilaipabean_akhir
 * @property float|null $denda
 * @property float|null $total_tagihan
 * @property float|null $bmi_nilai_akhir
 * @property float|null $bmp_nilai_akhir
 * @property float|null $bk_nilai_akhir
 * @property string|null $analisa
 * @property string|null $ket
 * @property string|null $npp_no
 * @property string|null $npp_tgl
 * @property string|null $st_no
 * @property string|null $st_tgl
 * @property string|null $nhpu_no
 * @property string|null $nhpu_tgl
 * @property int|null $pfpd1
 * @property int|null $pfpd2
 * @property int|null $kasipab1
 * @property string|null $spktnp_no
 * @property string|null $spktnp_tgl
 * @property string|null $spktnp_jthtempo
 * @property string|null $sspcp_no
 * @property string|null $sspcp_tgl
 * @property string|null $ntb
 * @property string|null $ntpn
 * @property int|null $status_akhir_banding
 * @property float|null $trf_ppn_t
 * @property float|null $trf_pph_t
 * @property float|null $trf_ppn
 * @property float|null $trf_pph
 * @property float|null $trf_ppnbm
 * @property float|null $trf_ppnbm_t
 * @property float|null $trf_bmad
 * @property float|null $trf_bmad_t
 * @property float|null $trf_bk_t
 * @property float|null $trf_bk
 * @property float|null $bk_nilai_awal
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property PenulAnalisPenyaji $kasipab10
 * @property PenulLinkTemaheader $linkHeaderTh
 * @property PenulAnalisPenyaji $pfpd10
 * @property PenulAnalisPenyaji $pfpd20
 */
class PenulDatatransaksTh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_datatransaks_th';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_header_th', 'seri_brg', 'kdskepfas', 'pfpd1', 'pfpd2', 'kasipab1', 'status_akhir_banding', 'created_by', 'updated_by'], 'integer'],
            [['flag_pusat', 'analisa'], 'string'],
            [['tglpib', 'npp_tgl', 'st_tgl', 'nhpu_tgl', 'spktnp_tgl', 'spktnp_jthtempo', 'sspcp_tgl', 'created_at', 'updated_at'], 'safe'],
            [['trf_bm', 'bm_nilai_awal', 'trf_bm_t', 'bm_t_nilai_akhir', 'bmbbs_nilai_akhir', 'bmad_nilai_akhir', 'bmdp_nilai_akhir', 'kurs', 'ppn_nilai_awal', 'ppn_t_nilai_akhir', 'ppnbbs_nilai_akhir', 'ppntdp_nilai_akhir', 'pph_nilai_awal', 'pph_t_nilai_akhir', 'pphbbs_nilai_akhir', 'pphdp_nilai_akhir', 'ppnbm_t_nilai_akhir', 'nilaipabean_awal', 'nilaipabean_akhir', 'denda', 'total_tagihan', 'bmi_nilai_akhir', 'bmp_nilai_akhir', 'bk_nilai_akhir', 'trf_ppn_t', 'trf_pph_t', 'trf_ppn', 'trf_pph', 'trf_ppnbm', 'trf_ppnbm_t', 'trf_bmad', 'trf_bmad_t', 'trf_bk_t', 'trf_bk', 'bk_nilai_awal'], 'number'],
            [['flag_pusat_ket'], 'string', 'max' => 20],
            [['kode_kantor'], 'string', 'max' => 6],
            [['pib'], 'string', 'max' => 12],
            [['npwp_imp'], 'string', 'max' => 30],
            [['imp', 'ntb', 'ntpn'], 'string', 'max' => 50],
            [['uraian_brg'], 'string', 'max' => 254],
            [['hs', 'hs_t'], 'string', 'max' => 15],
            [['ket'], 'string', 'max' => 255],
            [['npp_no', 'st_no', 'nhpu_no', 'spktnp_no', 'sspcp_no'], 'string', 'max' => 25],
            [['kasipab1'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['kasipab1' => 'id']],
            [['pfpd1'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['pfpd1' => 'id']],
            [['pfpd2'], 'exist', 'skipOnError' => true, 'targetClass' => PenulAnalisPenyaji::className(), 'targetAttribute' => ['pfpd2' => 'id']],
            [['link_header_th'], 'exist', 'skipOnError' => true, 'targetClass' => PenulLinkTemaheader::className(), 'targetAttribute' => ['link_header_th' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_header_th' => 'Link Header Th',
            'flag_pusat' => 'Flag Pusat',
            'flag_pusat_ket' => 'Flag Pusat Ket',
            'kode_kantor' => 'Kode Kantor',
            'pib' => 'Pib',
            'tglpib' => 'Tglpib',
            'seri_brg' => 'Seri Brg',
            'kdskepfas' => 'Kdskepfas',
            'npwp_imp' => 'Npwp Imp',
            'imp' => 'Imp',
            'uraian_brg' => 'Uraian Brg',
            'hs' => 'Hs',
            'trf_bm' => 'Trf Bm',
            'bm_nilai_awal' => 'Bm Nilai Awal',
            'hs_t' => 'Hs T',
            'trf_bm_t' => 'Trf Bm T',
            'bm_t_nilai_akhir' => 'Bm T Nilai Akhir',
            'bmbbs_nilai_akhir' => 'Bmbbs Nilai Akhir',
            'bmad_nilai_akhir' => 'Bmad Nilai Akhir',
            'bmdp_nilai_akhir' => 'Bmdp Nilai Akhir',
            'kurs' => 'Kurs',
            'ppn_nilai_awal' => 'Ppn Nilai Awal',
            'ppn_t_nilai_akhir' => 'Ppn T Nilai Akhir',
            'ppnbbs_nilai_akhir' => 'Ppnbbs Nilai Akhir',
            'ppntdp_nilai_akhir' => 'Ppntdp Nilai Akhir',
            'pph_nilai_awal' => 'Pph Nilai Awal',
            'pph_t_nilai_akhir' => 'Pph T Nilai Akhir',
            'pphbbs_nilai_akhir' => 'Pphbbs Nilai Akhir',
            'pphdp_nilai_akhir' => 'Pphdp Nilai Akhir',
            'ppnbm_t_nilai_akhir' => 'Ppnbm T Nilai Akhir',
            'nilaipabean_awal' => 'Nilaipabean Awal',
            'nilaipabean_akhir' => 'Nilaipabean Akhir',
            'denda' => 'Denda',
            'total_tagihan' => 'Total Tagihan',
            'bmi_nilai_akhir' => 'Bmi Nilai Akhir',
            'bmp_nilai_akhir' => 'Bmp Nilai Akhir',
            'bk_nilai_akhir' => 'Bk Nilai Akhir',
            'analisa' => 'Analisa',
            'ket' => 'Ket',
            'npp_no' => 'Npp No',
            'npp_tgl' => 'Npp Tgl',
            'st_no' => 'St No',
            'st_tgl' => 'St Tgl',
            'nhpu_no' => 'Nhpu No',
            'nhpu_tgl' => 'Nhpu Tgl',
            'pfpd1' => 'Pfpd1',
            'pfpd2' => 'Pfpd2',
            'kasipab1' => 'Kasipab1',
            'spktnp_no' => 'Spktnp No',
            'spktnp_tgl' => 'Spktnp Tgl',
            'spktnp_jthtempo' => 'Spktnp Jthtempo',
            'sspcp_no' => 'Sspcp No',
            'sspcp_tgl' => 'Sspcp Tgl',
            'ntb' => 'Ntb',
            'ntpn' => 'Ntpn',
            'status_akhir_banding' => 'Status Akhir Banding',
            'trf_ppn_t' => 'Trf Ppn T',
            'trf_pph_t' => 'Trf Pph T',
            'trf_ppn' => 'Trf Ppn',
            'trf_pph' => 'Trf Pph',
            'trf_ppnbm' => 'Trf Ppnbm',
            'trf_ppnbm_t' => 'Trf Ppnbm T',
            'trf_bmad' => 'Trf Bmad',
            'trf_bmad_t' => 'Trf Bmad T',
            'trf_bk_t' => 'Trf Bk T',
            'trf_bk' => 'Trf Bk',
            'bk_nilai_awal' => 'Bk Nilai Awal',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Kasipab10]].
     *
     * @return \yii\db\ActiveQuery|PenulAnalisPenyajiQuery
     */
    public function getKasipab10()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'kasipab1']);
    }

    /**
     * Gets query for [[LinkHeaderTh]].
     *
     * @return \yii\db\ActiveQuery|PenulLinkTemaheaderQuery
     */
    public function getLinkHeaderTh()
    {
        return $this->hasOne(PenulLinkTemaheader::className(), ['id' => 'link_header_th']);
    }

    /**
     * Gets query for [[Pfpd10]].
     *
     * @return \yii\db\ActiveQuery|PenulAnalisPenyajiQuery
     */
    public function getPfpd10()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'pfpd1']);
    }

    /**
     * Gets query for [[Pfpd20]].
     *
     * @return \yii\db\ActiveQuery|PenulAnalisPenyajiQuery
     */
    public function getPfpd20()
    {
        return $this->hasOne(PenulAnalisPenyaji::className(), ['id' => 'pfpd2']);
    }

    /**
     * {@inheritdoc}
     * @return PenulDatatransaksThQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulDatatransaksThQuery(get_called_class());
    }
}
