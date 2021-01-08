<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ims_master".
 *
 * @property string $id
 * @property string $jenisims
 * @property string $ajuims
 * @property string $agenda
 * @property string $tglagenda
 * @property string $nomhnims
 * @property string $tglmhnims
 * @property string $jumlah
 * @property string $jenisbrg
 * @property string $spesbrg
 * @property string $pemilik
 * @property integer $idpemohon
 * @property string $kondisi
 * @property integer $negaraasal
 * @property string $val
 * @property double $np
 * @property string $hs
 * @property string $pelmasuk
 * @property string $tuj
 * @property string $lokasi
 * @property string $jatuhtempo
 * @property string $ditetapkan
 * @property integer $nipkk
 * @property integer $ekspedisipfpd
 * @property string $pib
 * @property string $tglpib
 * @property integer $np_rp
 * @property string $ket
 * @property integer $idpemeriksa
 * @property string $kasi
 * @property integer $statusselesai
 * @property string $nodokreal
 * @property string $tgldokreal
 * @property string $keputusan
 * @property string $memokasi
 * @property string $tglmemokasi
 * @property integer $pfpd
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property \app\models\ImsDetail[] $imsDetails
 * @property \app\models\Daftarpfpd $pfpd0
 * @property \app\models\Namapemeriksa $pemeriksa
 * @property \app\models\ImsTneg $negaraasal0
 * @property \app\models\Kakan $nipkk0
 * @property \app\models\ImsPemohon $pemohon
 */
class ImsMaster extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenisims', 'ajuims', 'kondisi', 'val', 'kasi', 'keputusan'], 'string'],
            [['tglagenda', 'tglmhnims', 'jatuhtempo', 'ditetapkan', 'tglpib', 'tgldokreal', 'tglmemokasi', 'created_at', 'updated_at'], 'safe'],
            [['nomhnims', 'tglmhnims'], 'required'],
            [['idpemohon', 'negaraasal', 'nipkk', 'ekspedisipfpd', 'np_rp', 'idpemeriksa', 'statusselesai', 'pfpd', 'created_by', 'updated_by'], 'integer'],
            [['np'], 'number'],
            [['agenda'], 'string', 'max' => 22],
            [['nomhnims'], 'string', 'max' => 25],
            [['jumlah', 'pemilik', 'pelmasuk', 'nodokreal', 'memokasi'], 'string', 'max' => 50],
            [['jenisbrg', 'spesbrg'], 'string', 'max' => 250],
            [['hs'], 'string', 'max' => 10],
            [['tuj', 'lokasi', 'ket'], 'string', 'max' => 200],
            [['pib'], 'string', 'max' => 6]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ims_master';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenisims' => 'Jenisims',
            'ajuims' => 'Ajuims',
            'agenda' => 'Agenda',
            'tglagenda' => 'Tglagenda',
            'nomhnims' => 'Nomhnims',
            'tglmhnims' => 'Tglmhnims',
            'jumlah' => 'Jumlah',
            'jenisbrg' => 'Jenisbrg',
            'spesbrg' => 'Spesbrg',
            'pemilik' => 'Pemilik',
            'idpemohon' => 'Idpemohon',
            'kondisi' => 'Kondisi',
            'negaraasal' => 'Negaraasal',
            'val' => 'Val',
            'np' => 'Np',
            'hs' => 'Hs',
            'pelmasuk' => 'Pelmasuk',
            'tuj' => 'Tuj',
            'lokasi' => 'Lokasi',
            'jatuhtempo' => 'Jatuhtempo',
            'ditetapkan' => 'Ditetapkan',
            'nipkk' => 'Nipkk',
            'ekspedisipfpd' => 'Ekspedisipfpd',
            'pib' => 'Pib',
            'tglpib' => 'Tglpib',
            'np_rp' => 'Np Rp',
            'ket' => 'Ket',
            'idpemeriksa' => 'Idpemeriksa',
            'kasi' => 'Kasi',
            'statusselesai' => 'Statusselesai',
            'nodokreal' => 'Nodokreal',
            'tgldokreal' => 'Tgldokreal',
            'keputusan' => 'Keputusan',
            'memokasi' => 'Memokasi',
            'tglmemokasi' => 'Tglmemokasi',
            'pfpd' => 'Pfpd',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsDetails()
    {
        return $this->hasMany(\app\models\ImsDetail::className(), ['link_ims' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfpd0()
    {
        return $this->hasOne(\app\models\Daftarpfpd::className(), ['id' => 'pfpd']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksa()
    {
        return $this->hasOne(\app\models\Namapemeriksa::className(), ['id' => 'idpemeriksa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNegaraasal0()
    {
        return $this->hasOne(\app\models\ImsTneg::className(), ['idpel' => 'negaraasal']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNipkk0()
    {
        return $this->hasOne(\app\models\Kakan::className(), ['id' => 'nipkk']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemohon()
    {
        return $this->hasOne(\app\models\ImsPemohon::className(), ['id' => 'idpemohon']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ImsMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ImsMasterQuery(get_called_class());
    }
}
