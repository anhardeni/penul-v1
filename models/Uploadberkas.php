<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "uploadberkas".
 *
 * @property int $id
 * @property int $id_berkas
 * @property int $no_dok
 * @property string $tgl_dok
 * @property string $ket
 * @property string $src_filename
 * @property string $web_filename
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $link_gambar
 * @property Berkas $berkas
 */
class Uploadberkas extends \yii\db\ActiveRecord
{

    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploadberkas';
    }

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            // 'class' => BlameableBehavior::className(),
            //            'updatedByAttribute' => false,

            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_berkas', 'link_gambar', 'updated_by',  'updated_at', 'no_dok','created_at' ,'created_by'], 'integer'],
            [['tgl_dok'], 'safe'],
            [['ket'], 'string', 'max' => 255],
            [['image'], 'safe'],
            [['image','web_filename'], 'file','maxFiles' => 6, 'extensions'=>'jpg, gif,png, pdf,doc,xls,xlsx'],
            [['image'], 'file', 'maxSize'=>'190520'],
            [['src_filename'], 'string', 'max' => 100],
            [['id_berkas'], 'exist', 'skipOnError' => true, 'targetClass' => Berkas::className(), 'targetAttribute' => ['id_berkas' => 'id']]
           // [['link_gambar'], 'exist', 'skipOnError' => true, 'targetClass' => PenulLinkTemaheader::className(), 'targetAttribute' => ['link_gambar' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}

     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_berkas' => 'Id Berkas',
            'no_dok' => 'No Dok',
            'tgl_dok' => 'Tgl Dok',
            'ket' => 'Ket',
            'src_filename' => 'Src Filename',
            //'web_filename' => 'Web Filename',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBerkas()
    {
        return $this->hasOne(Berkas::className(), ['id' => 'id_berkas']);
    }

    

 // public function getPenulLinkTemaheader()
 //    {
 //        return $this->hasOne(PenulLinkTemaheader::className(), ['id' => 'link_gambar']);
 //    }
    /**
     * {@inheritdoc}
     * @return UploadberkasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadberkasQuery(get_called_class());
    }
}
