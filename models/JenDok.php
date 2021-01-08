<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jen_dok".
 *
 * @property int $id
 * @property string $name
 * @property string|null $country_code
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property PenulHeader[] $penulHeaders
 */
class JenDok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jen_dok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['country_code'], 'string', 'max' => 3],
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
            'country_code' => 'Country Code',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[PenulHeaders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenulHeaders()
    {
        return $this->hasMany(PenulHeader::className(), ['jen_dok' => 'id']);
    }
}
