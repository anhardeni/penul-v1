<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "jmn_jenisdok".
 *
 * @property integer $id
 * @property string $jenisdokumen
 *
 * @property \app\models\JmnMaster[] $jmnMasters
 */
class JmnJenisdok extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenisdokumen'], 'required'],
            [['jenisdokumen'], 'string', 'max' => 40]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jmn_jenisdok';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenisdokumen' => 'Jenisdokumen',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJmnMasters()
    {
        return $this->hasMany(\app\models\JmnMaster::className(), ['jensdokdasar' => 'id']);
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
     * @return \app\models\JmnJenisdokQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\JmnJenisdokQuery(get_called_class());
    }
}
