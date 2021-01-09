<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "risalah_penul0".
 *
 * @property int $id
 * @property string|null $noagenda
 * @property string|null $nd
 * @property string|null $nd_tgl
 * @property string|null $rha
 * @property string|null $rha_tgl
 * @property string|null $perusahaan
 * @property string|null $pib
 * @property string|null $tglpib
 * @property int|null $seri_brg
 * @property string|null $keputusan_npp
 * @property string|null $fpkeputusan_NPP
 * @property string|null $fpket_NPP
 * @property string|null $laop
 * @property string|null $laop_tgl
 * @property string|null $kkp
 * @property string|null $kkp_tgl
 * @property string|null $npp
 * @property string|null $npp_tgl
 * @property string|null $st
 * @property string|null $st_tgl
 * @property string|null $pfpd
 * @property string|null $nhpu
 * @property string|null $nhpu_tgl
 * @property string|null $spktnp
 * @property string|null $spktnp_tgl
 * @property float|null $bm
 * @property float|null $bmad
 * @property float|null $bmi
 * @property float|null $bmdp
 * @property float|null $ppn
 * @property float|null $pph
 * @property float|null $denda
 * @property float|null $total_tagihan
 * @property string|null $spktnp_jthtempo
 * @property string|null $sspcp
 * @property string|null $sspcp_tgl
 * @property string|null $ntb
 * @property string|null $ntpn
 * @property int|null $status_akhir_banding
 * @property string|null $npp_rha_gab_1npp
 * @property string|null $npp_tgl_rha_gab_1npp
 * @property string|null $st_rha_gab_1npp
 * @property string|null $st_tgl_rha_gab_1npp
 * @property string|null $nhpu_rha_gab_1npp
 * @property string|null $nhpu_tgl_rha_gab_1npp
 * @property string|null $kasi
 * @property string|null $kabid
 * @property string|null $analis1
 * @property string|null $analis2
 * @property string|null $analis3
 * @property string|null $penyaji_data1
 * @property string|null $ket_risalah
 */
class RisalahPenul0 extends \yii\db\ActiveRecord
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
        return 'risalah_penul0';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seri_brg', 'status_akhir_banding'], 'integer'],
            [['nd_tgl', 'rha_tgl', 'tglpib', 'laop_tgl', 'kkp_tgl', 'npp_tgl', 'st_tgl', 'nhpu_tgl', 'spktnp_tgl', 'spktnp_jthtempo', 'sspcp_tgl', 'npp_tgl_rha_gab_1npp', 'st_tgl_rha_gab_1npp', 'nhpu_tgl_rha_gab_1npp'], 'safe'],
            [['fpkeputusan_NPP'], 'string'],
            [['bm', 'bmad', 'bmi', 'bmdp', 'ppn', 'pph', 'denda', 'total_tagihan'], 'number'],
            [['noagenda', 'perusahaan', 'keputusan_npp', 'pfpd', 'ntb', 'ntpn', 'kasi', 'kabid', 'analis1', 'analis2', 'analis3', 'penyaji_data1'], 'string', 'max' => 50],
            [['nd', 'rha', 'laop', 'kkp', 'npp', 'nhpu', 'spktnp', 'sspcp', 'npp_rha_gab_1npp', 'st_rha_gab_1npp', 'nhpu_rha_gab_1npp'], 'string', 'max' => 25],
            [['pib'], 'string', 'max' => 6],
            [['fpket_NPP'], 'string', 'max' => 20],
            [['st'], 'string', 'max' => 21],
            [['ket_risalah'], 'string', 'max' => 255],
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
            'nd' => 'Nd',
            'nd_tgl' => 'Nd Tgl',
            'rha' => 'Rha',
            'rha_tgl' => 'Rha Tgl',
            'perusahaan' => 'Perusahaan',
            'pib' => 'Pib',
            'tglpib' => 'Tglpib',
            'seri_brg' => 'Seri Brg',
            'keputusan_npp' => 'Keputusan Npp',
            'fpkeputusan_NPP' => 'Fpkeputusan Npp',
            'fpket_NPP' => 'Fpket Npp',
            'laop' => 'Laop',
            'laop_tgl' => 'Laop Tgl',
            'kkp' => 'Kkp',
            'kkp_tgl' => 'Kkp Tgl',
            'npp' => 'Npp',
            'npp_tgl' => 'Npp Tgl',
            'st' => 'St',
            'st_tgl' => 'St Tgl',
            'pfpd' => 'Pfpd',
            'nhpu' => 'Nhpu',
            'nhpu_tgl' => 'Nhpu Tgl',
            'spktnp' => 'Spktnp',
            'spktnp_tgl' => 'Spktnp Tgl',
            'bm' => 'Bm',
            'bmad' => 'Bmad',
            'bmi' => 'Bmi',
            'bmdp' => 'Bmdp',
            'ppn' => 'Ppn',
            'pph' => 'Pph',
            'denda' => 'Denda',
            'total_tagihan' => 'Total Tagihan',
            'spktnp_jthtempo' => 'Spktnp Jthtempo',
            'sspcp' => 'Sspcp',
            'sspcp_tgl' => 'Sspcp Tgl',
            'ntb' => 'Ntb',
            'ntpn' => 'Ntpn',
            'status_akhir_banding' => 'Status Akhir Banding',
            'npp_rha_gab_1npp' => 'Npp Rha Gab 1npp',
            'npp_tgl_rha_gab_1npp' => 'Npp Tgl Rha Gab 1npp',
            'st_rha_gab_1npp' => 'St Rha Gab 1npp',
            'st_tgl_rha_gab_1npp' => 'St Tgl Rha Gab 1npp',
            'nhpu_rha_gab_1npp' => 'Nhpu Rha Gab 1npp',
            'nhpu_tgl_rha_gab_1npp' => 'Nhpu Tgl Rha Gab 1npp',
            'kasi' => 'Kasi',
            'kabid' => 'Kabid',
            'analis1' => 'Analis1',
            'analis2' => 'Analis2',
            'analis3' => 'Analis3',
            'penyaji_data1' => 'Penyaji Data1',
            'ket_risalah' => 'Ket Risalah',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RisalahPenul0Query the active query used by this AR class.
     */
    public static function find()
    {
        return new RisalahPenul0Query(get_called_class());
    }
}
