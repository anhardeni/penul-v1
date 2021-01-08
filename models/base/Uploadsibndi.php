<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "uploadsibndi".
 *
 * @property string $id
 * @property integer $id_berkas
 * @property integer $no_dok
 * @property string $tgl_dok
 * @property string $src_filename
 * @property string $web_filename
 * @property string $fkidmohon
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 *
 * @property \app\models\Berkas $berkas
 * @property \app\models\Ttpermohonan $fkidmohon0
 */
class Uploadsibndi extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    public $image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_berkas', 'no_dok', 'fkidmohon', 'created_by'], 'integer'],
            [['tgl_dok', 'created_at', 'updated_at'], 'safe'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png, pdf'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['src_filename', 'web_filename'], 'string', 'max' => 100]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploadsibndi';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_berkas' => 'Id Berkas',
            'no_dok' => 'No Dok',
            'tgl_dok' => 'Tgl Dok',
            'src_filename' => 'Filename',
            'web_filename' => 'Pathname',
            'fkidmohon' => 'Fkidmohon',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBerkas()
    {
        return $this->hasOne(\app\models\Berkas::className(), ['id' => 'id_berkas']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkidmohon0()
    {
        return $this->hasOne(\app\models\Ttpermohonan::className(), ['id' => 'fkidmohon']);
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
            
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\UploadsibndiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\UploadsibndiQuery(get_called_class());
    }
}
