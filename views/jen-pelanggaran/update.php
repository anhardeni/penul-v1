<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenPelanggaran */

$this->title = 'Update Jen Pelanggaran: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Jen Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jen-pelanggaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
