<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "v_outstanding".
 *
 * @property string $nama
 * @property string $IN
 * @property string $OUT
 * @property string $OUTSTANDING
 */
class VOutstanding extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IN'], 'integer'],
            [['OUT', 'OUTSTANDING'], 'number'],
            [['nama'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_outstanding';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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
}
