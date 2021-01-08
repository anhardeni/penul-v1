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
 * @property string|null $fpkeputusan_NPP
 * @property string|null $fpket_NPP
 * @property string|null $npp
 * @property string|null $npp_tgl
 * @property string|null $st
 * @property string|null $st_tgl
 * @property int|null $pfpd pfpd pembuat kka
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
 * @property int|null $kasi kasi yg ikut dan berwenang
 * @property int|null $kabid kabid yg menyetujui
 * @property string $analis
 * @property string|null $ket_risalah
  * @property string|null $keputusan_npp
 */
class RisalahPenul0 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risalah_penul0';
    }

    /**
     * {@inheritdoc}
     */
             public static function primaryKey()
            {
                return ['id'];
            }

    public function rules()
    {
        return [
            [['id', 'seri_brg', 'pfpd', 'status_akhir_banding', 'kasi', 'kabid'], 'integer'],
            [['nd_tgl', 'rha_tgl', 'tglpib', 'npp_tgl', 'st_tgl', 'nhpu_tgl', 'spktnp_tgl', 'spktnp_jthtempo', 'sspcp_tgl'], 'safe'],
            [['fpkeputusan_NPP','keputusan_npp'], 'string'],
            [['bm', 'bmad', 'bmi', 'bmdp', 'ppn', 'pph', 'denda', 'total_tagihan'], 'number'],
            [['analis'], 'required'],
            [['noagenda', 'perusahaan', 'ntb', 'ntpn', 'analis'], 'string', 'max' => 50],
            [['nd', 'st'], 'string', 'max' => 21],
            [['rha', 'fpket_NPP'], 'string', 'max' => 20],
            [['pib'], 'string', 'max' => 6],
            [['npp', 'nhpu', 'spktnp', 'sspcp'], 'string', 'max' => 25],
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
            'fpkeputusan_NPP' => 'Fpkeputusan Npp',
            'keputusan_npp'=> 'keputusan_npp',
            'fpket_NPP' => 'Fpket Npp',
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
            'kasi' => 'Kasi',
            'kabid' => 'Kabid',
            'analis' => 'Analis',
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
