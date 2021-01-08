<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenulTema */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penul-tema-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->


    <div class="row">

        <div class="col-sm-4">

            <?= $form->field($model, 'tema')->textInput(['maxlength' => true]) ?>
             </div>
            <div class="col-sm-4">

            <?= $form->field($model, 'key_word')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-4">



            <?= $form->field($model, 'hs_awal')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hs_akhir')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-4">


            <?= $form->field($model, 'tarif_akhir')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'cara_tarik_datanya')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="row">

        <div class="col-sm-4">

            <?= $form->field($model, 'analisa')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'referensi')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-4">


            <?= $form->field($model, 'hint_1')->textInput(['maxlength' => true]) ?>
            
         </div>
            <div class="col-sm-4">


            <?= $form->field($model, 'hint_2')->textInput(['maxlength' => true]) ?> 
        </div>
            <div class="col-sm-4">


            <?= $form->field($model, 'hint_3')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-4">


            

            <?= $form->field($model, 'periode')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
