<?php

namespace app\models;

use \app\models\base\Uploadsibndi as BaseUploadsibndi;

/**
 * This is the model class for table "uploadsibndi".
 */
class Uploadsibndi extends BaseUploadsibndi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_berkas', 'no_dok', 'fkidmohon', 'created_by'], 'integer'],
            [['tgl_dok', 'created_at', 'updated_at'], 'safe'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png, pdf'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['src_filename', 'web_filename'], 'string', 'max' => 100]
        ]);
    }
	
}
