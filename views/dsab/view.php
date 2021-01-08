<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Dsab */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Dsab', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dsab-view">

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
            'tim_secondment',
            'nama_wp',
            'npwp',
            'kpp',
            'kanwil',
            'dsab_nondsab',
            'status',
            'rencana_tindaklanjut',
            'earlycalculation_sekber',
            'nilai_potensi',
            'realisasi',
            'gappotensi_dan_realisasi',
            'hal_yg_perlu_dieskalasi',
            'keterangan',
            'status_pemeriksaan',
            'follow_up',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
