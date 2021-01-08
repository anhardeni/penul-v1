<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ims_pemohon".
 *
 * @property integer $id
 * @property string $npwpimp
 * @property string $namaimp
 * @property string $alamatimp
 * @property string $pic
 * @property string $hp
 *
 * @property \app\models\ImsMaster[] $imsMasters
 * @property \app\models\ImsTtaju[] $imsTtajus
 */
class ImsPemohon extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['npwpimp', 'namaimp', 'alamatimp'], 'required'],
            [['npwpimp', 'pic'], 'string', 'max' => 50],
            [['namaimp'], 'string', 'max' => 255],
            [['alamatimp'], 'string', 'max' => 225],
            [['hp'], 'string', 'max' => 15]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ims_pemohon';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'npwpimp' => 'Npwpimp',
            'namaimp' => 'Namaimp',
            'alamatimp' => 'Alamatimp',
            'pic' => 'Pic',
            'hp' => 'Hp',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsMasters()
    {
        return $this->hasMany(\app\models\ImsMaster::className(), ['idpemohon' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsTtajus()
    {
        return $this->hasMany(\app\models\ImsTtaju::className(), ['idpemohon' => 'id']);
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
     * @return \app\models\ImsPemohonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ImsPemohonQuery(get_called_class());
    }
}
