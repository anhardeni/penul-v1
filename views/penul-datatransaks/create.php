<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenulDatatransaks */

$this->title = 'Penul Datatransaks Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Datatransaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-datatransaks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
