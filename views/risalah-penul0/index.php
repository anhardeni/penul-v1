<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
//use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\grid\GridView;





/* @var $this yii\web\View */
/* @var $searchModel app\controllers\RisalahPenul0Search */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Daftar Risalah Penul0';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risalah-penul0-index">

   
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>        <?=  Html::a('Risalah Penul0 Baru', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>
<?php
$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
                ['attribute' => 'id', 'visible' => false],
                [
            'attribute' => 'id', 
            'width' => '200px',
            'group' => true, 
            ],
            'noagenda',
            'nd',
            //'nd_tgl',
            [
    'attribute'=>'nd_tgl', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'],

            'rha',
           //  'rha_tgl',
                    [
    'attribute'=>'rha_tgl', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'],
             'perusahaan',
             'pib',
           //  'tglpib',
                              [
    'attribute'=>'tglpib', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'],
             'seri_brg',
             'keputusan_npp',
             'fpkeputusan_NPP',
             'fpket_NPP',
             'npp',
         //    'npp_tgl',
             [
    'attribute'=>'npp_tgl', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'],
             'st',
       //      'st_tgl',
             [
    'attribute'=>'st_tgl', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'],
             'pfpd',
             'nhpu',
          //   'nhpu_tgl',
             [
    'attribute'=>'nhpu_tgl', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'],
             'spktnp',
             //'spktnp_tgl',
             [
    'attribute'=>'spktnp_tgl', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'],
             'bm',
              [
            'attribute' => 'status',
            'pageSummary' => 'Total',
            'pageSummaryOptions' => ['class' => 'text-right'],
                ]
        ,
        //'earlycalculation_sekber',
                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'bm',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],

                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'ppn',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],

                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'pph',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],
        //'nilai_potensi',
                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'denda',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],
        //'realisasi',
                [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'total_tagihan',
                'format' => ['decimal', 0],
                'pageSummary' => true
                ],

            // 'bmad',
            // 'bmi',
            // 'bmdp',
             'ppn',
             'pph',
             'denda',
             'total_tagihan',
             'spktnp_jthtempo',
             'sspcp',
             'sspcp_tgl',
            // 'ntb',
            // 'ntpn',
             'status_akhir_banding',
             'kasi',
             'kabid',
             'analis',
            // 'ket risalah',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'],$this->context->route),    ],    ];

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'pagination'-> 'pageSize'=10,
          'hover' => true,
    'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
         'columns' => $gridColumns,
         'resizableColumns'=>true,
        //'dataProvider'->pagination=> false,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if($model->keputusan_npp =='DAPAT DILAKUKAN PENUL')
                {return ['class'=>'info'];}
            else{
                if($model->keputusan_npp =='DILAKUKAN PENUL (SEBAGIAN)')
                {return ['class'=>'danger'];}
                    else{
                        if($model->keputusan_npp =='TIDAK-DAPAT DILAKUKAN PENUL')
                {return ['class'=>'success'];}
                        else{
                        if($model->keputusan_npp =='Sudah SP2DK')
                {return ['class'=>'warning'];}
                         else{
                        if($model->keputusan_npp =='Pindah kanwil')
                {return ['class'=>'primary'];}
                        }
                        }

                    }
            }
        },
        'showPageSummary' => true,
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['top'=>'50'].
        
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






   

