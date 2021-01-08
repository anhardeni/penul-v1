<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenulDummydatatransaks */

$this->title = 'Penul Dummydatatransaks Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Dummydatatransaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-dummydatatransaks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
