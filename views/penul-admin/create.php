<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenulHeader */

$this->title = 'Penul Header Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Header', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
