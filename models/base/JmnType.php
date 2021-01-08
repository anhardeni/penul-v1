<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "jmn_type".
 *
 * @property integer $id
 * @property string $typejaminan
 *
 * @property \app\models\JmnMaster[] $jmnMasters
 */
class JmnType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typejaminan'], 'required'],
            [['typejaminan'], 'string', 'max' => 40]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jmn_type';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typejaminan' => 'Typejaminan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJmnMasters()
    {
        return $this->hasMany(\app\models\JmnMaster::className(), ['jaminantype' => 'id']);
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
     * @return \app\models\JmnTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\JmnTypeQuery(get_called_class());
    }
}
