<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use hscstudio\mimin\components\Mimin;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            'link_header',
            //'flag_pusat',
            //'flag_pusat_ket',
            //'kode_kantor',
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
            // 'bmbbs_nilai_akhir',
            // 'bmad_nilai_akhir',
            // 'bmdp_nilai_akhir',
            // 'kurs',
             'ppn_nilai_awal',
             'ppn_t_nilai_akhir',
            // 'ppnbbs_nilai_akhir',
            // 'ppntdp_nilai_akhir',
             'pph_nilai_awal',
             'pph_t_nilai_akhir',
            // 'pphbbs_nilai_akhir',
            // 'pphdp_nilai_akhir',
            // 'ppnbm_t_nilai_akhir',
             'nilaipabean_awal',
            // 'nilaipabean_akhir',
            // 'denda',
             'total_tagihan',
            // 'bmi_nilai_akhir',
            // 'bmp_nilai_akhir',
            // 'bk_nilai_akhir',
            // 'analisa:ntext',
            // 'ket',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            ];


// $this->title = 'Import Data: ' . $model ->id;
// $this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Header', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model ->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'import data';


?>
<h1>Import Data penul PPh 7.5%</h1>
<?php
$form = ActiveForm::begin([
    'options' => ['enctype'=> 'multipart/form-data'],
]) ?>
<?= $form->field($modelImport,'fileImport')->fileInput() ?>
<p> 
 <?= Html::submitButton('Import data direct pph 7.5% ',['class'=>'btn btn-info',

'data' => [
            'confirm' => 'Are you sure you want to Impor data penul ?',
                                   ],
]) ?>

</p>

<div>

</div>
 

<?php ActiveForm::end() ?>

<div class="penul-dummydatatransaks-index">

   
    <!-- <?php Pjax::begin(); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/pindahdata"))){ ?>        <?=  Html::a('insert ke database', ['pindahdata'], ['class' => 'btn btn-warning']) ?>
    <?php } ?>    </p> -->


      <!-- <p> <?php if ((Mimin::checkRoute($this->context->id."/pindahdatadirect"))){ ?>        <?=  Html::a('insert ke database', ['pindahdatadirect'], ['class' => 'btn btn-danger']) ?>
    <?php } ?>    </p> -->

    <!-- <p> <?php if ((Mimin::checkRoute($this->context->id."/view"))){ ?>  <?=  Html::a('view', ['view', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?php } ?>    

 
    <?php if ((Mimin::checkRoute($this->context->id."/update")))
       { ?>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       <?php } ?>
</p>
 -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,       
    ]); ?>
    <?php Pjax::end(); ?>
</div>