<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ims_tneg".
 *
 * @property integer $idpel
 * @property string $negarapelabuhan
 *
 * @property \app\models\ImsMaster[] $imsMasters
 */
class ImsTneg extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['negarapelabuhan'], 'required'],
            [['negarapelabuhan'], 'string', 'max' => 55]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ims_tneg';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpel' => 'Idpel',
            'negarapelabuhan' => 'Negarapelabuhan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsMasters()
    {
        return $this->hasMany(\app\models\ImsMaster::className(), ['negaraasal' => 'idpel']);
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
     * @return \app\models\ImsTnegQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ImsTnegQuery(get_called_class());
    }
}
