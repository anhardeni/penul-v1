<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "minta_data".
 *
 * @property int $id
 * @property string $perihal
 * @property string $tim_secondment
 * @property string $email_tujuan
 * @property string $email_penerima
 * @property string $contents
 * @property string $attachment
 * @property string $ttd
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property MintaDatadetail[] $mintaDatadetails
 */
class MintaData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'minta_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['perihal', 'tim_secondment', 'email_tujuan', 'email_penerima', 'contents', 'attachment', 'ttd'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perihal' => 'Perihal',
            'tim_secondment' => 'Tim Secondment',
            'email_tujuan' => 'Email Tujuan',
            'email_penerima' => 'Email Penerima',
            'contents' => 'Contents',
            'attachment' => 'Attachment',
            'ttd' => 'Ttd',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMintaDatadetails()
    {
        return $this->hasMany(MintaDatadetail::className(), ['minta_data_fk' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MintaDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MintaDataQuery(get_called_class());
    }
}
