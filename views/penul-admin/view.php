<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\PenulHeader */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Header', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-header-view">

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
            'noagenda',
            'jen_dok',
            'jen_pelanggaran',
            'analisa_prosedur_rha:ntext',
            'analisa_prosedur_rha2:ntext',
            'analisa_prosedur_rha3:ntext',
            'analisa_prosedur_rha4:ntext',
            'analisa_prosedur_rha5:ntext',
            'analisa_prosedur_rha6:ntext',
            'analisa_prosedur_rha7:ntext',
            'kesimpulan_rha_jum_pt',
            'kesimpulan_rha_nilaipotensi',
            'kesimpulan_laop',
            'penyaji_data1',
            'penyaji_data2',
            'analis1',
            'analis2',
            'analis3',
            'nd',
            'nd_tgl',
            'rha',
            'rha_tgl',
            'npp',
            'npp_tgl',
            'keputusan_npp',
            'st',
            'st_tgl',
            'nhpu',
            'nhpu_tgl',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
