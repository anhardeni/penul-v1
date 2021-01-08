<?php
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
/* @var $this yii\web\View */
?>
<div>
    <?php
    $form = ActiveForm::begin([
            'options' => [ 'enctype' => 'multipart/form-data']
    ]);
    ?>
    <?= $form->field($model, 'nama'); ?>
    <?= $form->field($model, 'file')->fileInput(); ?>
    <?php if ($model->file_id): ?>
        <div class="form-group">
            <?= Html::img(['/file', 'id' => $model->file_id]) ?>
        </div>
    <?php endif; ?>
 
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>