<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DsabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dsab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tim_secondment') ?>

    <?= $form->field($model, 'nama_wp') ?>

    <?= $form->field($model, 'npwp') ?>

    <?= $form->field($model, 'kpp') ?>

    <?php // echo $form->field($model, 'kanwil') ?>

    <?php // echo $form->field($model, 'dsab_nondsab') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'rencana_tindaklanjut') ?>

    <?php // echo $form->field($model, 'earlycalculation_sekber') ?>

    <?php // echo $form->field($model, 'nilai_potensi') ?>

    <?php // echo $form->field($model, 'realisasi') ?>

    <?php // echo $form->field($model, 'gappotensi_dan_realisasi') ?>

    <?php // echo $form->field($model, 'hal_yg_perlu_dieskalasi') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'status_pemeriksaan') ?>

    <?php // echo $form->field($model, 'follow_up') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
