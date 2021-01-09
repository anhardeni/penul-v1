<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\RisalahPenul0Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="risalah-penul0-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'noagenda') ?>

    <?= $form->field($model, 'nd') ?>

    <?= $form->field($model, 'nd_tgl') ?>

    <?= $form->field($model, 'rha') ?>

    <?php // echo $form->field($model, 'rha_tgl') ?>

    <?php // echo $form->field($model, 'perusahaan') ?>

    <?php // echo $form->field($model, 'pib') ?>

    <?php // echo $form->field($model, 'tglpib') ?>

    <?php // echo $form->field($model, 'seri_brg') ?>

    <?php // echo $form->field($model, 'keputusan_npp') ?>

    <?php // echo $form->field($model, 'fpkeputusan_NPP') ?>

    <?php // echo $form->field($model, 'fpket_NPP') ?>

    <?php // echo $form->field($model, 'laop') ?>

    <?php // echo $form->field($model, 'laop_tgl') ?>

    <?php // echo $form->field($model, 'kkp') ?>

    <?php // echo $form->field($model, 'kkp_tgl') ?>

    <?php // echo $form->field($model, 'npp') ?>

    <?php // echo $form->field($model, 'npp_tgl') ?>

    <?php // echo $form->field($model, 'st') ?>

    <?php // echo $form->field($model, 'st_tgl') ?>

    <?php // echo $form->field($model, 'pfpd') ?>

    <?php // echo $form->field($model, 'nhpu') ?>

    <?php // echo $form->field($model, 'nhpu_tgl') ?>

    <?php // echo $form->field($model, 'spktnp') ?>

    <?php // echo $form->field($model, 'spktnp_tgl') ?>

    <?php // echo $form->field($model, 'bm') ?>

    <?php // echo $form->field($model, 'bmad') ?>

    <?php // echo $form->field($model, 'bmi') ?>

    <?php // echo $form->field($model, 'bmdp') ?>

    <?php // echo $form->field($model, 'ppn') ?>

    <?php // echo $form->field($model, 'pph') ?>

    <?php // echo $form->field($model, 'denda') ?>

    <?php // echo $form->field($model, 'total_tagihan') ?>

    <?php // echo $form->field($model, 'spktnp_jthtempo') ?>

    <?php // echo $form->field($model, 'sspcp') ?>

    <?php // echo $form->field($model, 'sspcp_tgl') ?>

    <?php // echo $form->field($model, 'ntb') ?>

    <?php // echo $form->field($model, 'ntpn') ?>

    <?php // echo $form->field($model, 'status_akhir_banding') ?>

    <?php // echo $form->field($model, 'npp_rha_gab_1npp') ?>

    <?php // echo $form->field($model, 'npp_tgl_rha_gab_1npp') ?>

    <?php // echo $form->field($model, 'st_rha_gab_1npp') ?>

    <?php // echo $form->field($model, 'st_tgl_rha_gab_1npp') ?>

    <?php // echo $form->field($model, 'nhpu_rha_gab_1npp') ?>

    <?php // echo $form->field($model, 'nhpu_tgl_rha_gab_1npp') ?>

    <?php // echo $form->field($model, 'kasi') ?>

    <?php // echo $form->field($model, 'kabid') ?>

    <?php // echo $form->field($model, 'analis1') ?>

    <?php // echo $form->field($model, 'analis2') ?>

    <?php // echo $form->field($model, 'analis3') ?>

    <?php // echo $form->field($model, 'penyaji_data1') ?>

    <?php // echo $form->field($model, 'ket_risalah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
