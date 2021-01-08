<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MintaData */

$this->title = 'Update Minta Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Minta Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="minta-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
