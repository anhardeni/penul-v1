<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "jmn_master".
 *
 * @property string $id
 * @property string $idnoagenda
 * @property string $noagendakantor
 * @property string $tglagenda
 * @property string $tglpembuatan
 * @property integer $jaminantype
 * @property integer $kegiatankepabeanan
 * @property integer $jensdokdasar
 * @property string $nodokdasar
 * @property string $tgldokdasar
 * @property integer $namaperusahaan
 * @property integer $penjamin
 * @property integer $jaminannontunai
 * @property string $nojaminan
 * @property string $tglljaminan
 * @property string $tgljatuhtempo
 * @property string $nilaijaminan
 * @property integer $berkasselesai
 * @property integer $jnsberkasselesai
 * @property string $noberkasselesai
 * @property string $tglberkasselesai
 * @property string $keterangan
 * @property string $kasikeberatan
 * @property integer $namapemeriksa
 * @property string $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property \app\models\JmnJeniskegiatan $kegiatankepabeanan0
 * @property \app\models\JmnType $jaminantype0
 * @property \app\models\JmnJenisdok $jensdokdasar0
 * @property \app\models\ImsPemohon $namaperusahaan0
 * @property \app\models\JmnPenjamin $penjamin0
 * @property \app\models\Namapemeriksa $namapemeriksa0
 * @property \app\models\JmnJnsberkasselesai $jnsberkasselesai0
 */
class JmnMaster extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tglagenda', 'tglpembuatan', 'tgldokdasar', 'tglljaminan', 'tgljatuhtempo', 'tglberkasselesai', 'created_at', 'updated_at'], 'safe'],
            [['jaminantype', 'kegiatankepabeanan', 'jensdokdasar', 'namaperusahaan', 'penjamin', 'jaminannontunai', 'berkasselesai', 'jnsberkasselesai', 'namapemeriksa', 'created_by', 'updated_by'], 'integer'],
            [['jensdokdasar', 'jaminannontunai', 'tgljatuhtempo'], 'required'],
            [['nilaijaminan'], 'number'],
            [['keterangan', 'kasikeberatan'], 'string'],
            [['idnoagenda', 'noagendakantor', 'nojaminan', 'noberkasselesai'], 'string', 'max' => 50],
            [['nodokdasar'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jmn_master';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idnoagenda' => 'Idnoagenda',
            'noagendakantor' => 'Noagendakantor',
            'tglagenda' => 'Tglagenda',
            'tglpembuatan' => 'Tglpembuatan',
            'jaminantype' => 'Jaminantype',
            'kegiatankepabeanan' => 'Kegiatankepabeanan',
            'jensdokdasar' => 'Jensdokdasar',
            'nodokdasar' => 'Nodokdasar',
            'tgldokdasar' => 'Tgldokdasar',
            'namaperusahaan' => 'Namaperusahaan',
            'penjamin' => 'Penjamin',
            'jaminannontunai' => 'Jaminannontunai',
            'nojaminan' => 'Nojaminan',
            'tglljaminan' => 'Tglljaminan',
            'tgljatuhtempo' => 'Tgljatuhtempo',
            'nilaijaminan' => 'Nilaijaminan',
            'berkasselesai' => 'Berkasselesai',
            'jnsberkasselesai' => 'Jnsberkasselesai',
            'noberkasselesai' => 'Noberkasselesai',
            'tglberkasselesai' => 'Tglberkasselesai',
            'keterangan' => 'Keterangan',
            'kasikeberatan' => 'Kasikeberatan',
            'namapemeriksa' => 'Namapemeriksa',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKegiatankepabeanan0()
    {
        return $this->hasOne(\app\models\JmnJeniskegiatan::className(), ['id' => 'kegiatankepabeanan']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJaminantype0()
    {
        return $this->hasOne(\app\models\JmnType::className(), ['id' => 'jaminantype']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJensdokdasar0()
    {
        return $this->hasOne(\app\models\JmnJenisdok::className(), ['id' => 'jensdokdasar']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNamaperusahaan0()
    {
        return $this->hasOne(\app\models\ImsPemohon::className(), ['id' => 'namaperusahaan']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenjamin0()
    {
        return $this->hasOne(\app\models\JmnPenjamin::className(), ['id' => 'penjamin']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNamapemeriksa0()
    {
        return $this->hasOne(\app\models\Namapemeriksa::className(), ['id' => 'namapemeriksa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnsberkasselesai0()
    {
        return $this->hasOne(\app\models\JmnJnsberkasselesai::className(), ['id' => 'jnsberkasselesai']);
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
     * @return \app\models\JmnMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\JmnMasterQuery(get_called_class());
    }
}
