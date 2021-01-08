<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenulHeader */

$this->title = 'Update Penul Header: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Header', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penul-header-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPenulDatatransaks' => $modelsPenulDatatransaks,

    ]) ?>

</div>
