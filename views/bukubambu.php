<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenulHeader */
/* @var $form ActiveForm */
?>
<div class="bukubambu">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'jen_dok') ?>
        <?= $form->field($model, 'jen_pelanggaran') ?>
        <?= $form->field($model, 'penyaji_data1') ?>
        <?= $form->field($model, 'analis1') ?>
        <?= $form->field($model, 'kesimpulan_rha_jum_pt') ?>
        <?= $form->field($model, 'penyaji_data2') ?>
        <?= $form->field($model, 'analis2') ?>
        <?= $form->field($model, 'analis3') ?>
        <?= $form->field($model, 'created_by') ?>
        <?= $form->field($model, 'updated_by') ?>
        <?= $form->field($model, 'kesimpulan_rha_nilaipotensi') ?>
        <?= $form->field($model, 'nd_tgl') ?>
        <?= $form->field($model, 'rha_tgl') ?>
        <?= $form->field($model, 'npp_tgl') ?>
        <?= $form->field($model, 'st_tgl') ?>
        <?= $form->field($model, 'nhpu_tgl') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
        <?= $form->field($model, 'noagenda') ?>
        <?= $form->field($model, 'kesimpulan_laop') ?>
        <?= $form->field($model, 'nd') ?>
        <?= $form->field($model, 'st') ?>
        <?= $form->field($model, 'rha') ?>
        <?= $form->field($model, 'npp') ?>
        <?= $form->field($model, 'nhpu') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- bukubambu -->
