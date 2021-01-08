<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "pfpd_uploadkep".
 *
 * @property string $id
 * @property integer $id_berkas
 * @property integer $no_dok
 * @property string $tgl_dok
 * @property string $src_filename
 * @property string $web_filename
 * @property string $fkpfpdkep_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 *
 * @property \app\models\Berkas $berkas
 * @property \app\models\PfpdKep $fkpfpdkep
 */
class PfpdUploadkep extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_berkas', 'no_dok', 'fkpfpdkep_id', 'created_by'], 'integer'],
            [['tgl_dok', 'created_at', 'updated_at'], 'safe'],
            [['src_filename', 'web_filename'], 'string', 'max' => 100]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pfpd_uploadkep';
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
            'src_filename' => 'Src Filename',
            'web_filename' => 'Web Filename',
            'fkpfpdkep_id' => 'Fkpfpdkep ID',
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
    public function getFkpfpdkep()
    {
        return $this->hasOne(\app\models\PfpdKep::className(), ['id' => 'fkpfpdkep_id']);
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
     * @return \app\models\PfpdUploadkepQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PfpdUploadkepQuery(get_called_class());
    }
}
