<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;

/**
 * This is the model class for table "penul_analis_penyaji".
 *
 * @property int $id
 * @property string $name
 * @property string|null $nip
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string $status
 * @property string $src_filename
 * @property string $web_filename
 * @property PenulHeader[] $penulHeaders
 * @property PenulHeader[] $penulHeaders0
 * @property PenulHeader[] $penulHeaders1
 * @property PenulHeader[] $penulHeaders2
 * @property PenulHeader[] $penulHeaders3
 */
class PenulAnalisPenyaji extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_analis_penyaji';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'90520'],
            [['src_filename', 'web_filename'], 'string', 'max' => 100],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['nip'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'nip' => 'Nip',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status' => 'Status',
        ];
    }


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            
        ];
    }
    /**
     * Gets query for [[PenulHeaders]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
    public function getPenulHeaders()
    {
        return $this->hasMany(PenulHeader::className(), ['analis1' => 'id']);
    }

    /**
     * Gets query for [[PenulHeaders0]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
    public function getPenulHeaders0()
    {
        return $this->hasMany(PenulHeader::className(), ['analis2' => 'id']);
    }

    /**
     * Gets query for [[PenulHeaders1]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
    public function getPenulHeaders1()
    {
        return $this->hasMany(PenulHeader::className(), ['analis3' => 'id']);
    }

    /**
     * Gets query for [[PenulHeaders2]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
    public function getPenulHeaders2()
    {
        return $this->hasMany(PenulHeader::className(), ['penyaji_data1' => 'id']);
    }

    /**
     * Gets query for [[PenulHeaders3]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
    public function getPenulHeaders3()
    {
        return $this->hasMany(PenulHeader::className(), ['penyaji_data2' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PenulAnalisPenyajiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulAnalisPenyajiQuery(get_called_class());
    }
}
