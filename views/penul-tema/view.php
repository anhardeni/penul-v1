<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\PenulTema */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Tema', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-tema-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

             
        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-dark',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus item ini??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tema',
            'key_word',
            'hs_awal',
            'hs_akhir',
            'tarif_akhir',
            'cara_tarik_datanya',
            'analisa',
            'referensi',
            'hint_1',
            'hint_2',
            'hint_3',
            'periode',
            'created_at',
            'created_by',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
