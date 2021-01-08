<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UploadedFile */

$this->title = 'Uploaded File Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Uploaded File', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploaded-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
