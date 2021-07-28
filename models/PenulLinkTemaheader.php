<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "penul_link_temaheader".
 *
 * @property int $id
 * @property int|null $link_tema
 * @property int|null $link_header
 * @property string|null $keyword_specific
 * @property string|null $dap_rha
 * @property string|null $dap_rha2
 * @property string|null $dap_rha3
 * @property resource|null $dap_rha4
 * @property string|null $dap_rha5
 * @property string|null $dap_rha6
 * @property string|null $dap_rha7
 * @property string|null $data_pib
 * @property string|null $data_gambar
 * @property string|null $data_gambar_filename
 * @property string|null $data_pib_filename
 * @property string|null $periode_tarik_data
 * @property int|null $link_upload_berkas
 * @property string|null $ket
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property PenulHeader $linkHeader
 * @property PenulTema $linkTema
 * @property Uploadberkas $linkUploadBerkas
 */
class PenulLinkTemaheader extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;

    public $image1a;
    public $file1a;/**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penul_link_temaheader';
    }


    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            // 'class' => BlameableBehavior::className(),
            //            'updatedByAttribute' => false,
            
            TimestampBehavior::className(),
           // 'value' => new Expression('NOW()'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_tema', 'link_header', 'link_upload_berkas', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['dap_rha', 'dap_rha2', 'dap_rha3', 'dap_rha4', 'dap_rha5', 'dap_rha6', 'dap_rha7'], 'string'],
            [['periode_tarik_data'], 'safe'],
            [['image1a', 'file1a'], 'safe'],
            [['image1a'], 'file', 'extensions'=>'jpg, jpeg, gif, png'],
            [['file1a'], 'file', 'extensions'=>'xls,xlsx,pdf'],
            [['image1a'], 'file', 'maxSize'=>'190520', 'maxFiles' => 6],
            [['file1a'], 'file', 'maxSize'=>'990520'],
            [['keyword_specific'], 'string', 'max' => 50],
            [['data_pib', 'data_gambar', 'data_gambar_filename', 'data_pib_filename'], 'string', 'max' => 100],
            [['ket'], 'string', 'max' => 155],
            [['link_tema'], 'exist', 'skipOnError' => true, 'targetClass' => PenulTema::className(), 'targetAttribute' => ['link_tema' => 'id']],
            [['link_header'], 'exist', 'skipOnError' => true, 'targetClass' => PenulHeader::className(), 'targetAttribute' => ['link_header' => 'id']],
            [['link_upload_berkas'], 'exist', 'skipOnError' => true, 'targetClass' => Uploadberkas::className(), 'targetAttribute' => ['link_upload_berkas' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_tema' => 'Link Tema',
            'link_header' => 'Link Header',
            'keyword_specific' => 'Keyword Specific',
            'dap_rha' => 'Dap Rha',
            'dap_rha2' => 'Dap Rha2',
            'dap_rha3' => 'Dap Rha3',
            'dap_rha4' => 'Dap Rha4',
            'dap_rha5' => 'Dap Rha5',
            'dap_rha6' => 'Dap Rha6',
            'dap_rha7' => 'Dap Rha7',
            'data_pib' => 'Data Pib',
            'data_gambar' => 'Data Gambar',
            'data_gambar_filename' => 'Data Gambar Filename',
            'data_pib_filename' => 'Data Pib Filename',
            'periode_tarik_data' => 'Periode Tarik Data',
            'link_upload_berkas' => 'Link Upload Berkas',
            'ket' => 'Ket',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[LinkHeader]].
     *
     * @return \yii\db\ActiveQuery|PenulHeaderQuery
     */
   public function getListIdm()
    {
        return $this->hasMany(PenulLinkThIdm::className(), ['link_th_idm' => 'id']);
    }

    public function setListIdm($value)
    {
        $this->loadRelated("listIdm", $value);
    }




    public function getLinkHeader()
    {
        return $this->hasOne(PenulHeader::className(), ['id' => 'link_header']);
    }

    /**
     * Gets query for [[LinkTema]].
     *
     * @return \yii\db\ActiveQuery|PenulTemaQuery
     */
    public function getLinkTema()
    {
        return $this->hasOne(PenulTema::className(), ['id' => 'link_tema']);
    }

    public function getLinkTemaName(){
        $model=$this->link_tema;
    
        return $model?$model->id:'';
    }

     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }


    /**
     * Gets query for [[LinkUploadBerkas]].
     *
     * @return \yii\db\ActiveQuery|UploadberkasQuery
     */
    public function getLinkUploadBerkas()
    {
        return $this->hasOne(Uploadberkas::className(), ['id' => 'link_upload_berkas']);
    }

    /**
     * {@inheritdoc}
     * @return PenulLinkTemaheaderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenulLinkTemaheaderQuery(get_called_class());
    }
}
