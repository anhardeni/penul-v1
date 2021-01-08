<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dsab */

$this->title = 'Dsab Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Dsab', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dsab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
