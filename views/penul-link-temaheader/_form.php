<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \stkevich\ckeditor5\EditorClassic;
use kartik\file\FileInput;
//use \itstructure\CKEditor;
//use \itstructure\ckeditor\CKEditorAsset;

/* @var $this yii\web\View */
/* @var $model app\models\PenulLinkTemaheader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-link-temaheader-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'link_tema')->textInput() ?>

    <?= $form->field($model, 'link_header')->textInput() ?>


    <?= $form->field($model, 'keyword_specific')->textInput(['maxlength' => true]) ?>

   <div class="col-sm-6">
    <?= $form->field($model, 'dap_rha')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'imageUpload', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/penul-link-temaheader/upfile',
                ]
            ) ?>
            </div>
            <label>Latar Belakang</label>
    <?= $form->field($model, 'dap_rha2')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '',
                ]
            ) ?>


      <label>Identifikasi Permasalahan</label> 
    <?= $form->field($model, 'dap_rha3')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
    <?= $form->field($model, 'dap_rha4')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
    <label>Identifikasi Barang</label>
    <?= $form->field($model, 'dap_rha5')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>


    <label>Penetapan HS Code</label>
    <?= $form->field($model, 'dap_rha6')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>

    <?= $form->field($model, 'dap_rha7')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
      

    
<?= $form->field($model, 'file1a')->widget(FileInput::classname(), [
              'options' => ['accept' => '*/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['xls','xlsx'],'showUpload' => false,],
          ]);   ?>

   
    <?= $form->field($model, 'image1a')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','jpeg','pdf','png'],'showUpload' => false,],
          ]);   ?>

    
   

    <?= $form->field($model, 'periode_tarik_data')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl',
                                    'autoclose' => true
                                ]
                            ],
                        ]); ?>

    <?= $form->field($model, 'link_upload_berkas')->textInput() ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
