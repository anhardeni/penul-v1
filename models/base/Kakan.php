<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "kakan".
 *
 * @property integer $id
 * @property string $nip
 * @property string $pfpd
 * @property string $status
 *
 * @property \app\models\ImsMaster[] $imsMasters
 */
class Kakan extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'pfpd'], 'required'],
            [['status'], 'string'],
            [['nip'], 'string', 'max' => 15],
            [['pfpd'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kakan';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'pfpd' => 'Pfpd',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsMasters()
    {
        return $this->hasMany(\app\models\ImsMaster::className(), ['nipkk' => 'id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\KakanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\KakanQuery(get_called_class());
    }
}
