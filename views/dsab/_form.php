<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dsab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dsab-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'tim_secondment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_wp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kanwil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dsab_nondsab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rencana_tindaklanjut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'earlycalculation_sekber')->textInput() ?>

    <?= $form->field($model, 'nilai_potensi')->textInput() ?>

    <?= $form->field($model, 'realisasi')->textInput() ?>

    <?= $form->field($model, 'gappotensi_dan_realisasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hal_yg_perlu_dieskalasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_pemeriksaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'follow_up')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
