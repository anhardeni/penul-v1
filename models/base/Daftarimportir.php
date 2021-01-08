<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "daftarimportir".
 *
 * @property integer $id
 * @property string $npwpimp
 * @property string $namaimp
 * @property string $alamatimp
 *
 * @property \app\models\Datakeberatan2016[] $datakeberatan2016s
 * @property \app\models\Ttpermohonan[] $ttpermohonans
 */
class Daftarimportir extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['npwpimp', 'namaimp'], 'required'],
            [['npwpimp'], 'string', 'max' => 50],
            [['namaimp'], 'string', 'max' => 255],
            [['alamatimp'], 'string', 'max' => 225]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daftarimportir';
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
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatakeberatan2016s()
    {
        return $this->hasMany(\app\models\Datakeberatan2016::className(), ['namaperusahaan' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTtpermohonans()
    {
        return $this->hasMany(\app\models\Ttpermohonan::className(), ['idpemohon' => 'id']);
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
     * @return \app\models\DaftarimportirQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\DaftarimportirQuery(get_called_class());
    }
}
