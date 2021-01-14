<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UploadsimpulSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploadsimpul-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'KD_KANTOR') ?>

    <?= $form->field($model, 'NO_DOK') ?>

    <?= $form->field($model, 'TGL_DOK') ?>

    <?= $form->field($model, 'NPWP') ?>

    <?php // echo $form->field($model, 'NM_PERUSAHAAN') ?>

    <?php // echo $form->field($model, 'SERI_BRG') ?>

    <?php // echo $form->field($model, 'UR_BRG') ?>

    <?php // echo $form->field($model, 'HS_AWAL') ?>

    <?php // echo $form->field($model, 'HS_AKHIR') ?>

    <?php // echo $form->field($model, 'NILAI_AWAL') ?>

    <?php // echo $form->field($model, 'NILAI_AKHIR') ?>

    <?php // echo $form->field($model, 'TRF_BEA_AWAL') ?>

    <?php // echo $form->field($model, 'TRF_BEA_AKHIR') ?>

    <?php // echo $form->field($model, 'TRF_PPN_AWAL') ?>

    <?php // echo $form->field($model, 'TRF_PPN_AKHIR') ?>

    <?php // echo $form->field($model, 'TRF_PPH_AWAL') ?>

    <?php // echo $form->field($model, 'TRF_PPH_AKHIR') ?>

    <?php // echo $form->field($model, 'TRF_PPNBM_AWAL') ?>

    <?php // echo $form->field($model, 'TRF_PPNBM_AKHIR') ?>

    <?php // echo $form->field($model, 'TRF_BMAD_AWAL') ?>

    <?php // echo $form->field($model, 'TRF_BMAD_AKHIR') ?>

    <?php // echo $form->field($model, 'UR_KET_RHA') ?>

    <?php // echo $form->field($model, 'POTENSI_BEA') ?>

    <?php // echo $form->field($model, 'POTENSI_BMAD') ?>

    <?php // echo $form->field($model, 'POTENSI_PPN') ?>

    <?php // echo $form->field($model, 'POTENSI_PPH') ?>

    <?php // echo $form->field($model, 'POTENSI_PPNBM') ?>

    <?php // echo $form->field($model, 'POTENSI_DENDA') ?>

    <?php // echo $form->field($model, 'TOTAL_POTENSI') ?>

    <?php // echo $form->field($model, 'KET_POTENSI') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
