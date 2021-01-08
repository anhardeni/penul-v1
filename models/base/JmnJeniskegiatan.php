<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "jmn_jeniskegiatan".
 *
 * @property integer $id
 * @property integer $type_jmn
 * @property string $kegiatan
 *
 * @property \app\models\JmnMaster[] $jmnMasters
 */
class JmnJeniskegiatan extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_jmn', 'kegiatan'], 'required'],
            [['type_jmn'], 'integer'],
            [['kegiatan'], 'string', 'max' => 30]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jmn_jeniskegiatan';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_jmn' => 'Type Jmn',
            'kegiatan' => 'Kegiatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJmnMasters()
    {
        return $this->hasMany(\app\models\JmnMaster::className(), ['kegiatankepabeanan' => 'id']);
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
     * @return \app\models\JmnJeniskegiatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\JmnJeniskegiatanQuery(get_called_class());
    }
}
