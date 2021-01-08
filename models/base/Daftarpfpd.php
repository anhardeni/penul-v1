<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "daftarpfpd".
 *
 * @property integer $id
 * @property string $nip
 * @property string $nama
 * @property string $status
 *
 * @property \app\models\Datakeberatan2016[] $datakeberatan2016s
 * @property \app\models\ImsMaster[] $imsMasters
 */
class Daftarpfpd extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'nama'], 'required'],
            [['status'], 'string'],
            [['nip'], 'string', 'max' => 15],
            [['nama'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daftarpfpd';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatakeberatan2016s()
    {
        return $this->hasMany(\app\models\Datakeberatan2016::className(), ['namapfpd' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsMasters()
    {
        return $this->hasMany(\app\models\ImsMaster::className(), ['pfpd' => 'id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    

    /**
     * @inheritdoc
     * @return \app\models\DaftarpfpdQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\DaftarpfpdQuery(get_called_class());
    }
}
