<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penul_link_th_idm".
 *
 * @property int $id
 * @property int|null $link_th_idm
 * @property string|null $idm_urut
 * @property string|null $idm_ket
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property PenulLinkTemaheader $linkThIdm
 */
class PenulLinkThIdm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_link_th_idm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_th_idm', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['idm_urut'], 'string', 'max' => 5],
            [['idm_ket'], 'string', 'max' => 500],
            [['link_th_idm'], 'exist', 'skipOnError' => true, 'targetClass' => PenulLinkTemaheader::className(), 'targetAttribute' => ['link_th_idm' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_th_idm' => 'Link Th Idm',
            'idm_urut' => 'Idm Urut',
            'idm_ket' => 'Idm Ket',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[LinkThIdm]].
     *
     * @return \yii\db\ActiveQuery|PenulLinkTemaheaderQuery
     */
    public function getLinkThIdm()
    {
        return $this->hasOne(PenulLinkTemaheader::className(), ['id' => 'link_th_idm']);
    }

    /**
     * {@inheritdoc}
     * @return PenulLinkThIdmQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulLinkThIdmQuery(get_called_class());
    }
}
