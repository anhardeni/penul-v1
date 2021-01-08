<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenulLinkTemaheader */

$this->title = 'Penul Link Temaheader Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Link Temaheader', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-link-temaheader-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
