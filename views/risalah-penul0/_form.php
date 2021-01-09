<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RisalahPenul0 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="risalah-penul0-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'noagenda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nd_tgl')->textInput() ?>

    <?= $form->field($model, 'rha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rha_tgl')->textInput() ?>

    <?= $form->field($model, 'perusahaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglpib')->textInput() ?>

    <?= $form->field($model, 'seri_brg')->textInput() ?>

    <?= $form->field($model, 'keputusan_npp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fpkeputusan_NPP')->dropDownList([ 'setuju' => 'Setuju', 'tolak ada SPKTNP' => 'Tolak ada SPKTNP', 'tolak sedang Audit' => 'Tolak sedang Audit', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'fpket_NPP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'laop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'laop_tgl')->textInput() ?>

    <?= $form->field($model, 'kkp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kkp_tgl')->textInput() ?>

    <?= $form->field($model, 'npp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npp_tgl')->textInput() ?>

    <?= $form->field($model, 'st')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'st_tgl')->textInput() ?>

    <?= $form->field($model, 'pfpd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nhpu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nhpu_tgl')->textInput() ?>

    <?= $form->field($model, 'spktnp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spktnp_tgl')->textInput() ?>

    <?= $form->field($model, 'bm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmdp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pph')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'denda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_tagihan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spktnp_jthtempo')->textInput() ?>

    <?= $form->field($model, 'sspcp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sspcp_tgl')->textInput() ?>

    <?= $form->field($model, 'ntb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ntpn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_akhir_banding')->textInput() ?>

    <?= $form->field($model, 'npp_rha_gab_1npp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npp_tgl_rha_gab_1npp')->textInput() ?>

    <?= $form->field($model, 'st_rha_gab_1npp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'st_tgl_rha_gab_1npp')->textInput() ?>

    <?= $form->field($model, 'nhpu_rha_gab_1npp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nhpu_tgl_rha_gab_1npp')->textInput() ?>

    <?= $form->field($model, 'kasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kabid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'analis1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'analis2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'analis3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penyaji_data1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_risalah')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
