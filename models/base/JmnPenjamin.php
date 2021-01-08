<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "jmn_penjamin".
 *
 * @property integer $id
 * @property string $penjaminbank
 *
 * @property \app\models\JmnMaster[] $jmnMasters
 */
class JmnPenjamin extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penjaminbank'], 'required'],
            [['penjaminbank'], 'string', 'max' => 100]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jmn_penjamin';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'penjaminbank' => 'Penjaminbank',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJmnMasters()
    {
        return $this->hasMany(\app\models\JmnMaster::className(), ['penjamin' => 'id']);
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
     * @return \app\models\JmnPenjaminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\JmnPenjaminQuery(get_called_class());
    }
}
