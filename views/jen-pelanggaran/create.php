<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JenPelanggaran */

$this->title = 'Jen Pelanggaran Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Jen Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jen-pelanggaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
