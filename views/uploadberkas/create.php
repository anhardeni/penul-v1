<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Uploadberkas */

$this->title = 'Uploadberkas Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Uploadberkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadberkas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
