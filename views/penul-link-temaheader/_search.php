<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\PenulLinkTemaheaderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-link-temaheader-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'link_tema') ?>

    <?= $form->field($model, 'link_header') ?>

    <?= $form->field($model, 'keyword_specific') ?>

    <?= $form->field($model, 'dap_rha') ?>

    <?php // echo $form->field($model, 'dap_rha2') ?>

    <?php // echo $form->field($model, 'dap_rha3') ?>

    <?php // echo $form->field($model, 'dap_rha4') ?>

    <?php // echo $form->field($model, 'dap_rha5') ?>

    <?php // echo $form->field($model, 'dap_rha6') ?>

    <?php // echo $form->field($model, 'dap_rha7') ?>

    <?php // echo $form->field($model, 'data_pib') ?>

    <?php // echo $form->field($model, 'data_gambar') ?>

    <?php // echo $form->field($model, 'data_gambar_filename') ?>

    <?php // echo $form->field($model, 'data_pib_filename') ?>

    <?php // echo $form->field($model, 'periode_tarik_data') ?>

    <?php // echo $form->field($model, 'link_upload_berkas') ?>

    <?php // echo $form->field($model, 'ket') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
