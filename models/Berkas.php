<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "berkas".
 *
 * @property int $id
 * @property string $berkas
 *
 * @property Uploadberkas[] $uploadberkas
 */
class Berkas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'berkas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['berkas'], 'required'],
            [['berkas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function getUploadberkas()
    {
        return $this->hasMany(Uploadberkas::className(), ['id_berkas' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BerkasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BerkasQuery(get_called_class());
    }
}
