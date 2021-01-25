<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\PenulAnalisPenyaji */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Analis Penyaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-analis-penyaji-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus item ini??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'nip',
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',
            'updated_by',
            'status',
        ],
    ]) ?>

</div>
