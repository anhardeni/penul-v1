<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\RisalahPenul0 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Risalah Penul0', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risalah-penul0-view">

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
            'nd',
            'nd_tgl',
            'rha',
            'rha_tgl',
            'perusahaan',
            'pib',
            'tglpib',
            'seri_brg',
            'keputusan_npp',
            'fpkeputusan_NPP',
            'fpket_NPP',
            'laop',
            'laop_tgl',
            'kkp',
            'kkp_tgl',
            'npp',
            'npp_tgl',
            'st',
            'st_tgl',
            'pfpd',
            'nhpu',
            'nhpu_tgl',
            'spktnp',
            'spktnp_tgl',
            'bm',
            'bmad',
            'bmi',
            'bmdp',
            'ppn',
            'pph',
            'denda',
            'total_tagihan',
            'spktnp_jthtempo',
            'sspcp',
            'sspcp_tgl',
            'ntb',
            'ntpn',
            'status_akhir_banding',
            'npp_rha_gab_1npp',
            'npp_tgl_rha_gab_1npp',
            'st_rha_gab_1npp',
            'st_tgl_rha_gab_1npp',
            'nhpu_rha_gab_1npp',
            'nhpu_tgl_rha_gab_1npp',
            'kasi',
            'kabid',
            'analis1',
            'analis2',
            'analis3',
            'penyaji_data1',
            'ket_risalah',
        ],
    ]) ?>

</div>
