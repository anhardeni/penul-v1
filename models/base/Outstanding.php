<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "outstanding".
 *
 * @property integer $id
 * @property string $nama
 * @property string $IN
 * @property string $OUT
 * @property string $OUTSTANDING
 */
class Outstanding extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'IN'], 'integer'],
            [['OUT', 'OUTSTANDING'], 'number'],
            [['nama'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outstanding';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'IN' => 'In',
            'OUT' => 'Out',
            'OUTSTANDING' => 'Outstanding',
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
     * @return \app\models\OutstandingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OutstandingQuery(get_called_class());
    }
}
