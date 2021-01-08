<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenulAnalisPenyaji */

$this->title = 'Penul Analis Penyaji Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Analis Penyaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-analis-penyaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
