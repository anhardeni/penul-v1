<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenulDatatransaks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-datatransaks-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'link_header')->textInput() ?>

    <?= $form->field($model, 'flag_pusat')->dropDownList([ 'setuju' => 'Setuju', 'tolak ada SPKTNP' => 'Tolak ada SPKTNP', 'tolak sedang Audit' => 'Tolak sedang Audit', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'flag_pusat_ket')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_kantor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglpib')->textInput() ?>

    <?= $form->field($model, 'seri_brg')->textInput() ?>

    <?= $form->field($model, 'npwp_imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uraian_brg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trf_bm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bm_nilai_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hs_t')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trf_bm_t')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bm_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kurs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppn_nilai_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppn_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pph_nilai_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pph_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppnbm_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilaipabean_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilaipabean_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'denda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_tagihan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
