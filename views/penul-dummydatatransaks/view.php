<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\PenulDummydatatransaks */

$this->title = $model->kode_kantor;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Dummydatatransaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-dummydatatransaks-view">

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
            'link_header',
            'flag_pusat',
            'flag_pusat_ket',
            'kode_kantor',
            'pib',
            'tglpib',
            'seri_brg',
            'kdskepfas',
            'npwp_imp',
            'imp',
            'uraian_brg',
            'hs',
            'trf_bm',
            'bm_nilai_awal',
            'hs_t',
            'trf_bm_t',
            'bm_t_nilai_akhir',
            'bmbbs_nilai_akhir',
            'bmad_nilai_akhir',
            'bmdp_nilai_akhir',
            'kurs',
            'ppn_nilai_awal',
            'ppn_t_nilai_akhir',
            'ppnbbs_nilai_akhir',
            'ppntdp_nilai_akhir',
            'pph_nilai_awal',
            'pph_t_nilai_akhir',
            'pphbbs_nilai_akhir',
            'pphdp_nilai_akhir',
            'ppnbm_t_nilai_akhir',
            'nilaipabean_awal',
            'nilaipabean_akhir',
            'denda',
            'total_tagihan',
            'bmi_nilai_akhir',
            'bmp_nilai_akhir',
            'bk_nilai_akhir',
            'analisa:ntext',
            'ket',
            'npp_no',
            'npp_tgl',
            'st_no',
            'st_tgl',
            'nhpu_no',
            'nhpu_tgl',
            'pfpd1',
            'pfpd2',
            'kasipab1',
            'spktnp_no',
            'spktnp_tgl',
            'spktnp_jthtempo',
            'sspcp_no',
            'sspcp_tgl',
            'ntb',
            'ntpn',
            'status_akhir_banding',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
