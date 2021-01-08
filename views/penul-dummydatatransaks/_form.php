<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenulDummydatatransaks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-dummydatatransaks-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'link_header')->textInput() ?>

    <?= $form->field($model, 'flag_pusat')->dropDownList([ 'setuju' => 'Setuju', 'tolak ada SPKTNP' => 'Tolak ada SPKTNP', 'tolak sedang Audit' => 'Tolak sedang Audit', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'flag_pusat_ket')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_kantor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglpib')->textInput() ?>

    <?= $form->field($model, 'seri_brg')->textInput() ?>

    <?= $form->field($model, 'kdskepfas')->textInput() ?>

    <?= $form->field($model, 'npwp_imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uraian_brg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trf_bm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bm_nilai_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hs_t')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trf_bm_t')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bm_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmbbs_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmad_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmdp_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kurs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppn_nilai_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppn_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppnbbs_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppntdp_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pph_nilai_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pph_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pphbbs_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pphdp_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppnbm_t_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilaipabean_awal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilaipabean_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'denda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_tagihan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmi_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmp_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bk_nilai_akhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'analisa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npp_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npp_tgl')->textInput() ?>

    <?= $form->field($model, 'st_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'st_tgl')->textInput() ?>

    <?= $form->field($model, 'nhpu_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nhpu_tgl')->textInput() ?>

    <?= $form->field($model, 'pfpd1')->textInput() ?>

    <?= $form->field($model, 'pfpd2')->textInput() ?>

    <?= $form->field($model, 'kasipab1')->textInput() ?>

    <?= $form->field($model, 'spktnp_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spktnp_tgl')->textInput() ?>

    <?= $form->field($model, 'spktnp_jthtempo')->textInput() ?>

    <?= $form->field($model, 'sspcp_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sspcp_tgl')->textInput() ?>

    <?= $form->field($model, 'ntb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ntpn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_akhir_banding')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
