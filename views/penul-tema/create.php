<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenulTema */

$this->title = 'Penul Tema Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Tema', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-tema-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
