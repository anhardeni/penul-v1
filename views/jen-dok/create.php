<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JenDok */

$this->title = 'Jen Dok Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Jen Dok', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jen-dok-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
