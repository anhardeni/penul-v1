<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
//use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\grid\GridView;


$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
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
            // 'bmad',
            // 'bmi',
            // 'bmdp',
             'ppn',
             'pph',
             'denda',
             'total_tagihan',
             'spktnp_jthtempo',
            // 'sspcp',
            // 'sspcp_tgl',
            // 'ntb',
            // 'ntpn',
             'status_akhir_banding',
             'kasi',
             'kabid',
            // 'analis',
            // 'ket risalah',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'],$this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\controllers\RisalahPenul0Search */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Daftar Risalah Penul0';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risalah-penul0-index">

   
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>        <?=  Html::a('Risalah Penul0 Baru', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns, 

         'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],     
    ]); ?>
   <?php Pjax::end(); ?>
</div>





<div class="dsab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dsab', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'tim_secondment',
        'nama_wp',
       // 'npwp',
        'kpp',
        //'kanwil',
        'dsab_nondsab',
        //'status',
        //'rencana_tindaklanjut',
                [
            'attribute' => 'status',
            'pageSummary' => 'T o t a l',
            'pageSummaryOptions' => ['class' => 'text-right'],
                ]
        ,
        //'earlycalculation_sekber',
                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'earlycalculation_sekber',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],
        //'nilai_potensi',
                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'nilai_potensi',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],
        //'realisasi',
                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'realisasi',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],

        'gappotensi_dan_realisasi',
        'hal_yg_perlu_dieskalasi',
        'keterangan',
        'status_pemeriksaan',
        //'follow_up',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
            //'pagination'-> 'pageSize'=120,
               

        //'dataProvider'->pagination=> false,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if($model->status =='Proses Analisa')
                {return ['class'=>'info'];}
            else{
                if($model->status =='Pemeriksaan')
                {return ['class'=>'danger'];}
                    else{
                        if($model->status =='Closing')
                {return ['class'=>'success'];}
                        else{
                        if($model->status =='Sudah SP2DK')
                {return ['class'=>'warning'];}
                         else{
                        if($model->status =='Pindah kanwil')
                {return ['class'=>'primary'];}
                        }
                        }

                    }
            }
        },
        'showPageSummary' => true,
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['top'=>'50'].
        'columns' => $gridColumn,
        //'hover' = true,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-dsab']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>