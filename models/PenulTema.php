<?php

namespace app\models;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "penul_tema".
 *
 * @property int $id
 * @property string $tema
 * @property string $key_word
 * @property string $hs_awal
 * @property string $hs_akhir
 * @property float $tarif_akhir
 * @property string $cara_tarik_datanya
 * @property string|null $analisa
 * @property string|null $referensi
 * @property string|null $hint_1
  * @property string|null $hint_2
   * @property string|null $hint_3
 * @property string|null $periode
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property PenulLinkTemaheader[] $penulLinkTemaheaders
 */
class PenulTema extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_tema';
    }

    public function behaviors()
{
    return [
        BlameableBehavior::className(),
        TimestampBehavior::className(),
    ];
}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tema', 'key_word', 'hs_awal', 'hs_akhir', 'tarif_akhir', 'cara_tarik_datanya'], 'required'],
            [['tarif_akhir'], 'number'],
            [['created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['tema', 'hs_awal', 'hs_akhir', 'periode'], 'string', 'max' => 50],
            [['key_word'], 'string', 'max' => 100],
            [['cara_tarik_datanya', 'hint_1', 'hint_2', 'hint_3'], 'string', 'max' => 255],
            [['analisa', 'referensi'], 'string', 'max' => 1052],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tema' => 'Tema',
            'key_word' => 'Key Word',
            'hs_awal' => 'Hs Awal',
            'hs_akhir' => 'Hs Akhir',
            'tarif_akhir' => 'Tarif Akhir',
            'cara_tarik_datanya' => 'Cara Tarik Datanya',
            'analisa' => 'Analisa',
            'referensi' => 'Referensi',
            'hint_1' => 'Hint1',
            'hint_2' => 'Hint2',
            'hint_3' => 'Hint3',
            'periode' => 'Periode',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PenulLinkTemaheaders]].
     *
     * @return \yii\db\ActiveQuery|PenulLinkTemaheaderQuery
     */
    public function getPenulLinkTemaheaders()
    {
        return $this->hasMany(PenulLinkTemaheader::className(), ['link_tema' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PenulTemaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulTemaQuery(get_called_class());
    }
}
