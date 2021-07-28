<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RhaVsNpp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rha-vs-npp-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'Penyaji')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IN-RHA')->textInput() ?>

    <?= $form->field($model, 'IN-NPP')->textInput() ?>

    <?= $form->field($model, 'OUTSTANDING-Pusat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
