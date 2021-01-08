<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenulAnalisPenyaji */

$this->title = 'Update Penul Analis Penyaji: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Analis Penyaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penul-analis-penyaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
