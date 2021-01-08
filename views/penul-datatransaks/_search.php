<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\PenulDatatransaksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-datatransaks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'link_header') ?>

    <?= $form->field($model, 'flag_pusat') ?>

    <?= $form->field($model, 'flag_pusat_ket') ?>

    <?= $form->field($model, 'kode_kantor') ?>

    <?php // echo $form->field($model, 'pib') ?>

    <?php // echo $form->field($model, 'tglpib') ?>

    <?php // echo $form->field($model, 'seri_brg') ?>

    <?php // echo $form->field($model, 'kdskepfas') ?>

    <?php // echo $form->field($model, 'npwp_imp') ?>

    <?php // echo $form->field($model, 'imp') ?>

    <?php // echo $form->field($model, 'uraian_brg') ?>

    <?php // echo $form->field($model, 'hs') ?>

    <?php // echo $form->field($model, 'trf_bm') ?>

    <?php // echo $form->field($model, 'bm_nilai_awal') ?>

    <?php // echo $form->field($model, 'hs_t') ?>

    <?php // echo $form->field($model, 'trf_bm_t') ?>

    <?php // echo $form->field($model, 'bm_t_nilai_akhir') ?>

    <?php // echo $form->field($model, 'bmbbs_nilai_akhir') ?>

    <?php // echo $form->field($model, 'bmad_nilai_akhir') ?>

    <?php // echo $form->field($model, 'bmdp_nilai_akhir') ?>

    <?php // echo $form->field($model, 'kurs') ?>

    <?php // echo $form->field($model, 'ppn_nilai_awal') ?>

    <?php // echo $form->field($model, 'ppn_t_nilai_akhir') ?>

    <?php // echo $form->field($model, 'ppnbbs_nilai_akhir') ?>

    <?php // echo $form->field($model, 'ppntdp_nilai_akhir') ?>

    <?php // echo $form->field($model, 'pph_nilai_awal') ?>

    <?php // echo $form->field($model, 'pph_t_nilai_akhir') ?>

    <?php // echo $form->field($model, 'pphbbs_nilai_akhir') ?>

    <?php // echo $form->field($model, 'pphdp_nilai_akhir') ?>

    <?php // echo $form->field($model, 'ppnbm_t_nilai_akhir') ?>

    <?php // echo $form->field($model, 'nilaipabean_awal') ?>

    <?php // echo $form->field($model, 'nilaipabean_akhir') ?>

    <?php // echo $form->field($model, 'denda') ?>

    <?php // echo $form->field($model, 'total_tagihan') ?>

    <?php // echo $form->field($model, 'bmi_nilai_akhir') ?>

    <?php // echo $form->field($model, 'bmp_nilai_akhir') ?>

    <?php // echo $form->field($model, 'bk_nilai_akhir') ?>

    <?php // echo $form->field($model, 'analisa') ?>

    <?php // echo $form->field($model, 'ket') ?>

    <?php // echo $form->field($model, 'npp_no') ?>

    <?php // echo $form->field($model, 'npp_tgl') ?>

    <?php // echo $form->field($model, 'st_no') ?>

    <?php // echo $form->field($model, 'st_tgl') ?>

    <?php // echo $form->field($model, 'nhpu_no') ?>

    <?php // echo $form->field($model, 'nhpu_tgl') ?>

    <?php // echo $form->field($model, 'pfpd1') ?>

    <?php // echo $form->field($model, 'pfpd2') ?>

    <?php // echo $form->field($model, 'kasipab1') ?>

    <?php // echo $form->field($model, 'spktnp_no') ?>

    <?php // echo $form->field($model, 'spktnp_tgl') ?>

    <?php // echo $form->field($model, 'spktnp_jthtempo') ?>

    <?php // echo $form->field($model, 'sspcp_no') ?>

    <?php // echo $form->field($model, 'sspcp_tgl') ?>

    <?php // echo $form->field($model, 'ntb') ?>

    <?php // echo $form->field($model, 'ntpn') ?>

    <?php // echo $form->field($model, 'status_akhir_banding') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
