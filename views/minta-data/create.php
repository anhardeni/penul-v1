<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MintaData */

$this->title = 'Minta Data Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Minta Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minta-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
