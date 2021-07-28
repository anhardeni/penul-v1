<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use hscstudio\mimin\components\Mimin;


?>
<h1>Upload Gbr ke 2-dst Rha drilling </h1>
<?php
$form = ActiveForm::begin([
    'options' => ['enctype'=> 'multipart/form-data'],
]) ?>

<?= $form->field($model,'web_filename[]')->fileInput(['multiple'=>true, 'accept' => 'image/*']) ?>

<p> 
 <?= Html::submitButton('upload gbe ke-2 dst  ',['class'=>'btn btn-info',

'data' => [
            'confirm' => 'Are you sure you want to Upload?',
                                   ],
]) ?>



</p>

<div>

</div>
 

<?php ActiveForm::end() ?>

    

</div>