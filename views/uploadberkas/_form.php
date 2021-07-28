<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Uploadberkas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploadberkas-form">

   <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->



    <?= $form->field($model, 'id_berkas')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\Berkas::find()->orderBy('id')->asArray()->all(), 'id','berkas'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>

    <?= $form->field($model, 'no_dok')->textInput() ?>

  <?= $form->field($model, 'tgl_dok')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Tgl Dok',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

   
   <?= $form->field($model, 'web_filename[]')->fileinput (['multiple'=>true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
