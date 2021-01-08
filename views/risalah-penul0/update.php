<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RisalahPenul0 */

$this->title = 'Update Risalah Penul0: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Risalah Penul0', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="risalah-penul0-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
