<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\PenulAdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-header-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'noagenda') ?>

    <?= $form->field($model, 'jen_dok') ?>

    <?= $form->field($model, 'jen_pelanggaran') ?>

    <?= $form->field($model, 'analisa_prosedur_rha') ?>

    <?php // echo $form->field($model, 'analisa_prosedur_rha2') ?>

    <?php // echo $form->field($model, 'analisa_prosedur_rha3') ?>

    <?php // echo $form->field($model, 'analisa_prosedur_rha4') ?>

    <?php // echo $form->field($model, 'analisa_prosedur_rha5') ?>

    <?php // echo $form->field($model, 'analisa_prosedur_rha6') ?>

    <?php // echo $form->field($model, 'analisa_prosedur_rha7') ?>

    <?php // echo $form->field($model, 'kesimpulan_rha_jum_pt') ?>

    <?php // echo $form->field($model, 'kesimpulan_rha_nilaipotensi') ?>

    <?php // echo $form->field($model, 'kesimpulan_laop') ?>

    <?php // echo $form->field($model, 'penyaji_data1') ?>

    <?php // echo $form->field($model, 'penyaji_data2') ?>

    <?php // echo $form->field($model, 'analis1') ?>

    <?php // echo $form->field($model, 'analis2') ?>

    <?php // echo $form->field($model, 'analis3') ?>

    <?php // echo $form->field($model, 'nd') ?>

    <?php // echo $form->field($model, 'nd_tgl') ?>

    <?php // echo $form->field($model, 'rha') ?>

    <?php // echo $form->field($model, 'rha_tgl') ?>

    <?php // echo $form->field($model, 'npp') ?>

    <?php // echo $form->field($model, 'npp_tgl') ?>

    <?php // echo $form->field($model, 'keputusan_npp') ?>

    <?php // echo $form->field($model, 'st') ?>

    <?php // echo $form->field($model, 'st_tgl') ?>

    <?php // echo $form->field($model, 'nhpu') ?>

    <?php // echo $form->field($model, 'nhpu_tgl') ?>

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
