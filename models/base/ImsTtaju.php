<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ims_ttaju".
 *
 * @property string $id
 * @property string $noagendakantor
 * @property string $tglterimapermohonan
 * @property integer $idpemohon
 * @property string $nosuratpermohonan
 * @property string $tglsuratpermohonan
 * @property integer $l_suratasli
 * @property integer $l_taksirannilai
 * @property integer $l_spekbrg
 * @property integer $l_kontrak
 * @property integer $l_pereksporkem
 * @property integer $l_perdokvalid
 * @property integer $l_identitas
 * @property integer $l_izinterkait
 * @property integer $l_perpejgunabrg
 * @property integer $l_aslisrtkuasa
 * @property integer $l_dokpelengkaplainnya
 * @property integer $l_doklainnya
 * @property integer $berkaslengkapbenar
 * @property string $ket
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property \app\models\ImsPemohon $pemohon
 */
class ImsTtaju extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tglterimapermohonan', 'tglsuratpermohonan', 'created_at', 'updated_at'], 'safe'],
            [['idpemohon', 'nosuratpermohonan'], 'required'],
            [['idpemohon', 'l_suratasli', 'l_taksirannilai', 'l_spekbrg', 'l_kontrak', 'l_pereksporkem', 'l_perdokvalid', 'l_identitas', 'l_izinterkait', 'l_perpejgunabrg', 'l_aslisrtkuasa', 'l_dokpelengkaplainnya', 'l_doklainnya', 'berkaslengkapbenar', 'created_by', 'updated_by'], 'integer'],
            [['noagendakantor'], 'string', 'max' => 50],
            [['nosuratpermohonan'], 'string', 'max' => 100],
            [['ket'], 'string', 'max' => 250]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ims_ttaju';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noagendakantor' => 'Noagendakantor',
            'tglterimapermohonan' => 'Tglterimapermohonan',
            'idpemohon' => 'Idpemohon',
            'nosuratpermohonan' => 'Nosuratpermohonan',
            'tglsuratpermohonan' => 'Tglsuratpermohonan',
            'l_suratasli' => 'L Suratasli',
            'l_taksirannilai' => 'L Taksirannilai',
            'l_spekbrg' => 'L Spekbrg',
            'l_kontrak' => 'L Kontrak',
            'l_pereksporkem' => 'L Pereksporkem',
            'l_perdokvalid' => 'L Perdokvalid',
            'l_identitas' => 'L Identitas',
            'l_izinterkait' => 'L Izinterkait',
            'l_perpejgunabrg' => 'L Perpejgunabrg',
            'l_aslisrtkuasa' => 'L Aslisrtkuasa',
            'l_dokpelengkaplainnya' => 'L Dokpelengkaplainnya',
            'l_doklainnya' => 'L Doklainnya',
            'berkaslengkapbenar' => 'Berkaslengkapbenar',
            'ket' => 'Ket',
        ];
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
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new\yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ImsTtajuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ImsTtajuQuery(get_called_class());
    }
}
