<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "pfpd_kep".
 *
 * @property string $id
 * @property string $tgmonitor
 * @property string $pib
 * @property string $tglpib
 * @property string $nosptnp
 * @property string $tglsptnp
 * @property integer $idpemohon
 * @property integer $pfpd
 * @property integer $risalah
 * @property integer $lppt_lppnp
 * @property string $tglkirimrisalah
 * @property integer $kirimdgnpib
 * @property integer $arsip
 * @property string $putusankepkeberatan
 * @property string $putusankebbanding
 * @property string $nokepkeberatan
 * @property string $tglkepkeberatan
 * @property string $ket
 * @property integer $idpemeriksa
 * @property string $kasi
 * @property integer $statusselesai
 * @property string $memokasi
 * @property string $tglmemokasi
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property \app\models\PfpdUploadkep[] $pfpdUploadkeps
 */
class PfpdKep extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tgmonitor', 'tglpib', 'tglsptnp', 'tglkirimrisalah', 'tglkepkeberatan', 'tglmemokasi', 'created_at', 'updated_at'], 'safe'],
            [['pib', 'tglpib', 'nosptnp', 'tglsptnp', 'putusankepkeberatan'], 'required'],
            [['idpemohon', 'pfpd', 'risalah', 'lppt_lppnp', 'kirimdgnpib', 'arsip', 'idpemeriksa', 'statusselesai', 'created_by', 'updated_by'], 'integer'],
            [['putusankepkeberatan', 'putusankebbanding', 'kasi'], 'string'],
            [['pib'], 'string', 'max' => 6],
            [['nosptnp'], 'string', 'max' => 25],
            [['nokepkeberatan', 'memokasi'], 'string', 'max' => 50],
            [['ket'], 'string', 'max' => 200]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pfpd_kep';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgmonitor' => 'Tgmonitor',
            'pib' => 'Pib',
            'tglpib' => 'Tglpib',
            'nosptnp' => 'Nosptnp',
            'tglsptnp' => 'Tglsptnp',
            'idpemohon' => 'Idpemohon',
            'pfpd' => 'Pfpd',
            'risalah' => 'Risalah',
            'lppt_lppnp' => 'Lppt Lppnp',
            'tglkirimrisalah' => 'Tglkirimrisalah',
            'kirimdgnpib' => 'Kirimdgnpib',
            'arsip' => 'Arsip',
            'putusankepkeberatan' => 'Putusankepkeberatan',
            'putusankebbanding' => 'Putusankebbanding',
            'nokepkeberatan' => 'Nokepkeberatan',
            'tglkepkeberatan' => 'Tglkepkeberatan',
            'ket' => 'Ket',
            'idpemeriksa' => 'Idpemeriksa',
            'kasi' => 'Kasi',
            'statusselesai' => 'Statusselesai',
            'memokasi' => 'Memokasi',
            'tglmemokasi' => 'Tglmemokasi',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfpdUploadkeps()
    {
        return $this->hasMany(\app\models\PfpdUploadkep::className(), ['fkpfpdkep_id' => 'id']);
    }
    
    

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\PfpdKepQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PfpdKepQuery(get_called_class());
    }
}
