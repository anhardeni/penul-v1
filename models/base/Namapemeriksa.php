<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "namapemeriksa".
 *
 * @property integer $id
 * @property string $nama
 * @property string $nip
 * @property string $status
 *
 * @property \app\models\Datakeberatan2016[] $datakeberatan2016s
 */
class Namapemeriksa extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['nama', 'nip'], 'string', 'max' => 50],
            [['nip'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'namapemeriksa';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'nip' => 'Nip',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatakeberatan2016s()
    {
        return $this->hasMany(\app\models\Datakeberatan2016::className(), ['namapemeriksa' => 'id']);
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
     * @return \app\models\NamapemeriksaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\NamapemeriksaQuery(get_called_class());
    }
}
