<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "berkas".
 *
 * @property integer $id
 * @property string $berkas
 *
 * @property \app\models\Uploadsibndi[] $uploadsibndis
 */
class Berkas extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['berkas'], 'required'],
            [['berkas'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'berkas';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'berkas' => 'Berkas',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploadsibndis()
    {
        return $this->hasMany(\app\models\Uploadsibndi::className(), ['id_berkas' => 'id']);
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
     * @return \app\models\BerkasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BerkasQuery(get_called_class());
    }
}
