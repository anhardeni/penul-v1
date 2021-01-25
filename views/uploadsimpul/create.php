<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Uploadsimpul */

$this->title = 'Uploadsimpul Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Uploadsimpul', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadsimpul-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
