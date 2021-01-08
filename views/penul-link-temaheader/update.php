<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenulLinkTemaheader */

$this->title = 'Update Penul Link Temaheader: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Link Temaheader', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penul-link-temaheader-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
