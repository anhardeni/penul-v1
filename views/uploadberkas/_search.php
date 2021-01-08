<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UploadberkasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploadberkas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_berkas') ?>

    <?= $form->field($model, 'no_dok') ?>

    <?= $form->field($model, 'tgl_dok') ?>

    <?= $form->field($model, 'ket') ?>

    <?php // echo $form->field($model, 'src_filename') ?>

    <?php // echo $form->field($model, 'web_filename') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
