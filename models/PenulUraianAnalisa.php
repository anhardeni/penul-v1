<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penul_uraian_analisa".
 *
 * @property int $id
 * @property int $link_header2
 * @property string|null $ur_analisis_prosedur
 * @property string|null $ket
 *
 * @property PenulHeader $linkHeader2
 */
class PenulUraianAnalisa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_uraian_analisa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_header2'], 'required'],
            [['link_header2'], 'integer'],
            [['ur_analisis_prosedur'], 'string'],
            [['ket'], 'string', 'max' => 200],
            [['link_header2'], 'exist', 'skipOnError' => true, 'targetClass' => PenulHeader::className(), 'targetAttribute' => ['link_header2' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_header2' => 'Link Header2',
            'ur_analisis_prosedur' => 'Ur Analisis Prosedur',
            'ket' => 'Ket',
        ];
    }

    /**
     * Gets query for [[LinkHeader2]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
    public function getLinkHeader2()
    {
        return $this->hasOne(PenulHeader::className(), ['id' => 'link_header2']);
    }

    /**
     * {@inheritdoc}
     * @return PenulUraianAnalisaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulUraianAnalisaQuery(get_called_class());
    }
}
