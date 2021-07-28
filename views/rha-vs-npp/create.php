<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RhaVsNpp */

$this->title = 'Rha Vs Npp Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Rha Vs Npp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rha-vs-npp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
