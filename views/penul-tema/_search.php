<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\PenulTemaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-tema-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tema') ?>

    <?= $form->field($model, 'key_word') ?>

    <?= $form->field($model, 'hs_awal') ?>

    <?= $form->field($model, 'hs_akhir') ?>

    <?php // echo $form->field($model, 'tarif_akhir') ?>

    <?php // echo $form->field($model, 'cara_tarik_datanya') ?>

    <?php // echo $form->field($model, 'analisa') ?>

    <?php // echo $form->field($model, 'referensi') ?>

    <?php // echo $form->field($model, 'hint_1') ?>

    <?php // echo $form->field($model, 'hint_2') ?>

    <?php // echo $form->field($model, 'hint_3') ?>

    <?php // echo $form->field($model, 'periode') ?>

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
