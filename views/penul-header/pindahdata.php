<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<h1>Pindahkan Data/h1>
<?php
$form = ActiveForm::begin([
    'options' => ['enctype'=> 'multipart/form-data'],
]) ?>


<?= Html::submitButton('Insert Ignore',['class'=>'btn btn-success',

'data' => [
                    'confirm' => 'Are you sure you want to Impor PIB Hijau ?',
                                   ],
]) ?>
 

<?php ActiveForm::end() ?>