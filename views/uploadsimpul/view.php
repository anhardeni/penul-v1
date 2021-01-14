<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Uploadsimpul */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Uploadsimpul', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadsimpul-view">

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
            'KD_KANTOR',
            'NO_DOK',
            'TGL_DOK',
            'NPWP',
            'NM_PERUSAHAAN',
            'SERI_BRG',
            'UR_BRG',
            'HS_AWAL',
            'HS_AKHIR',
            'NILAI_AWAL',
            'NILAI_AKHIR',
            'TRF_BEA_AWAL',
            'TRF_BEA_AKHIR',
            'TRF_PPN_AWAL',
            'TRF_PPN_AKHIR',
            'TRF_PPH_AWAL',
            'TRF_PPH_AKHIR',
            'TRF_PPNBM_AWAL',
            'TRF_PPNBM_AKHIR',
            'TRF_BMAD_AWAL',
            'TRF_BMAD_AKHIR',
            'UR_KET_RHA:ntext',
            'POTENSI_BEA',
            'POTENSI_BMAD',
            'POTENSI_PPN',
            'POTENSI_PPH',
            'POTENSI_PPNBM',
            'POTENSI_DENDA',
            'TOTAL_POTENSI',
            'KET_POTENSI',
        ],
    ]) ?>

</div>
