<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "datastatus".
 *
 * @property integer $id
 * @property integer $idkeberatan
 * @property integer $idimportir
 * @property string $idnoagenda
 * @property string $status
 * @property string $created_at
 * @property integer $idttpermohonan
 */
class Datastatus extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkeberatan', 'idimportir', 'idnoagenda', 'status', 'idttpermohonan'], 'required'],
            [['idkeberatan', 'idimportir', 'idttpermohonan'], 'integer'],
            [['created_at'], 'safe'],
            [['idnoagenda'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 100]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datastatus';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idkeberatan' => 'Idkeberatan',
            'idimportir' => 'Idimportir',
            'idnoagenda' => 'Idnoagenda',
            'status' => 'Status',
            'idttpermohonan' => 'Idttpermohonan',
        ];
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
     * @return \app\models\DatastatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\DatastatusQuery(get_called_class());
    }
}
