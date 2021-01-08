<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenulDatatransaks */

$this->title = 'Update Penul Datatransaks: ' . $model->kode_kantor;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Datatransaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_kantor, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penul-datatransaks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
