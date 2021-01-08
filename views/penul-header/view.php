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
       <?php if ((Mimin::checkRoute($this->context->id."/update")))
       { ?>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       <?php } ?>

         <!-- <?php if ((Mimin::checkRoute($this->context->id."/importdata")))
            { ?> 
              <?= Html::a('importdata', ['importdata','id' => $model->id], ['class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin import data (pastikan format data excel sudah sesuai) ???',
                                    ],
            ]) ?>
            <?php } ?> -->

           <?php if ((Mimin::checkRoute($this->context->id."/importdatadirect")))
            { ?>
             <?= Html::a('importdata direct ', ['importdatadirect','id' => $model->id], ['class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin import data (pastikan format data excel sudah sesuai) ???',
                                    ],
            ]) ?>
            <?php }  ?>  

    <!--    <?php if ((Mimin::checkRoute($this->context->id."/delete")))
            { ?> <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin menghapus item ini??',
                    'method' => 'post',
                ],
            ]) ?>
            <?php } ?> -->    

         <?php    if ((Mimin::checkRoute($this->context->id."/cetakrha")))
            { ?> <?= Html::a('cetak RHA', ['cetakrha','id' => $model->id], ['class' => 'btn btn-dark',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin cetak RHA ??',
                                    ],
            ]) ?>
            <?php } ?>     


            <?php  if ((Mimin::checkRoute($this->context->id."/cetakkkp")))
            { ?> <?= Html::a('cetak Kertas Kerja', ['cetakkkp','id' => $model->id], ['class' => 'btn btn-dark',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin cetak Kertas Kerja Penul  ??',
                                    ],
            ]) ?>
            <?php }   ?>   

           <?php  if ((Mimin::checkRoute($this->context->id."/cetaknhpu")))
            { ?> <?= Html::a('cetak NHPU', ['cetaknhpu','id' => $model->id], ['class' => 'btn btn-dark',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin cetak NHPU ??',
                                    ],
            ]) ?>
            <?php }  ?>  

            <div class="row">

            <?php  if ((Mimin::checkRoute($this->context->id."/cetaknhputtd")))
            { ?> <?= Html::a('cetak nhpu ttd', ['cetaknhputtd','id' => $model->id], ['class' => 'btn btn-info',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin cetak NHPU dengan ttd ??',
                                    ],
            ]) ?>
            <?php }  ?> 

            <?php  if ((Mimin::checkRoute($this->context->id."/cetakkkpttd")))
            { ?> <?= Html::a('cetak kkp ttd', ['cetakkkpttd','id' => $model->id], ['class' => 'btn btn-info',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin cetak Kertas Kerja Penul dengan ttd ??',
                                    ],
            ]) ?>
            <?php }  ?> 

              <!-- <?php if ((Mimin::checkRoute($this->context->id."/importdatadirect")))
            { ?>
             <?= Html::a('importdata direct PPh 7.5%', ['importdatadirect02','id' => $model->id], ['class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin import data (pastikan format data excel sudah sesuai) ???',
                                    ],
            ]) ?>
            <?php }  ?>  -->
            
          </div>
              </p>

            <!-- <button class="btn btn-warning" id="toggle-modal-1">Launch Modal</button>
            <script>
                $('#toggle-modal-1').fireModal({
                  title: 'My Modal',
                  body: 'Hello, dude!',
                  buttons: [
                  {
                      text: 'Close',
                      class: 'btn btn-secondary',
                      handler: function(current_modal) {
                          $.destroyModal(current_modal);
                      }
                  }
                  ]
              });
          </script>
 -->


<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'noagenda',
        'jen_dok',
        'jen_pelanggaran',
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
        'keputusan_npp',
        'npp',
        'npp_tgl',
        'st',
        'st_tgl',
        'nhpu',
        'nhpu_tgl',
        'analisa_prosedur_rha',
            //'created_at',
           // 'created_by',
          //  'updated_at',
          //  'updated_by',
    ],
]) ?>

</div>
 <h1> Data Penul  </h1>
 <table class="table table-bordered table-striped">

    <head>
        <tr>
            <th>flagpusat </th>
            <th>flagpusat ket </th>
            <th>kodekantor </th>
            <th>perusahaan </th>
            <th> pib </th>
            <th> tgl pib </th>
            <th> seri brg </th>
            <th>hs </th>
            <th>hs_t </th>
            <th>trf BM_t </th>
            <th>Devisa idr </th>
            <th>BM </th>
            <th> PPN </th>
            <th> pph </th>

        </tr>
    </head>
    <tbody>

          <?php foreach ($modelsPenulDatatransaks as $index => $modelPenulDatatransaks): ?>
               <tr>
                <td><?= $modelPenulDatatransaks->flag_pusat ?></td>
                <td><?= $modelPenulDatatransaks->flag_pusat_ket ?></td>
                <td><?= $modelPenulDatatransaks->kode_kantor ?></td>
                <td><?= $modelPenulDatatransaks->imp ?></td>
                <td><?= $modelPenulDatatransaks->pib ?></td>
                 <td><?= $modelPenulDatatransaks->tglpib ?></td>
                 <td><?= $modelPenulDatatransaks->seri_brg ?></td>
                 <td><?= $modelPenulDatatransaks->hs ?></td>
                <td><?= $modelPenulDatatransaks->hs_t ?></td>
                 <td><?= $modelPenulDatatransaks->trf_bm_t ?></td>
                <td><?= $modelPenulDatatransaks->nilaipabean_awal ?></td>
                <td><?= $modelPenulDatatransaks->bm_nilai_awal ?></td>
                 <td><?= $modelPenulDatatransaks->ppn_nilai_awal ?></td>
                 <td><?= $modelPenulDatatransaks->pph_nilai_awal ?></td>
               </tr>
           <?php endforeach; ?>
        

    </tbody>

  </table>




