<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Uploadsimpul */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploadsimpul-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'KD_KANTOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NO_DOK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TGL_DOK')->textInput() ?>

    <?= $form->field($model, 'NPWP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NM_PERUSAHAAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SERI_BRG')->textInput() ?>

    <?= $form->field($model, 'UR_BRG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HS_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HS_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NILAI_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NILAI_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_BEA_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_BEA_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_PPN_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_PPN_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_PPH_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_PPH_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_PPNBM_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_PPNBM_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_BMAD_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRF_BMAD_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UR_KET_RHA')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'POTENSI_BEA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POTENSI_BMAD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POTENSI_PPN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POTENSI_PPH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POTENSI_PPNBM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POTENSI_DENDA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_POTENSI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KET_POTENSI')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
