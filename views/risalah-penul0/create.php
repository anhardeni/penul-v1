<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RisalahPenul0 */

$this->title = 'Risalah Penul0 Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Risalah Penul0', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risalah-penul0-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
