<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
//use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
['attribute' => 'id','label'=> 'ref-id'],
'KD_KANTOR',
'NO_DOK',
            // 'TGL_DOK',
[
    'attribute'=>'TGL_DOK', 
    'format'=>['date', 'php:d-m-yy'], 
    'width'=>'150px'
],
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
         //   'UR_KET_RHA:ntext',
'POTENSI_BEA',
'POTENSI_BMAD',
'POTENSI_PPN',
'POTENSI_PPH',
'POTENSI_PPNBM',
'POTENSI_DENDA',
'TOTAL_POTENSI',
'KET_POTENSI',

['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
  'view'],$this->context->route),    ],    ];
/* @var $this yii\web\View */
/* @var $searchModel app\models\UploadsimpulSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Uploadsimpul';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadsimpul-index">

  <?= Yii::$app->params['bsVersion'] ?>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
   //'autoXlFormat'=>true,
        //'pagination'-> 'pageSize'=10,
    'columns' => $gridColumns,
    'showOnEmpty'=>false,
    'resizableColumns'=>true,
        //'dataProvider'->pagination=> false,
    'filterModel' => $searchModel,
        // 'rowOptions'=>function($model){
        //     if($model->keputusan_npp =='DAPAT DILAKUKAN PENUL')
        //         {return ['class'=>'info'];}
        //     else{
        //         if($model->keputusan_npp =='DILAKUKAN PENUL (SEBAGIAN)')
        //         {return ['class'=>'danger'];}
        //             else{
        //                 if($model->keputusan_npp =='TIDAK-DAPAT DILAKUKAN PENUL')
        //         {return ['class'=>'success'];}
        //                 else{
        //                 if($model->keputusan_npp =='Sudah SP2DK')
        //         {return ['class'=>'warning'];}
        //                  else{
        //                 if($model->keputusan_npp =='Pindah kanwil')
        //         {return ['class'=>'primary'];}
        //                 }
        //                 }

        //             }
        //     }
        // },
       // 'showPageSummary' => true,
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['top'=>'50'].

        //'hover' = true,
    'pjax' => true,
    'pjaxSettings' => [
        'neverTimeout'=>true,
        'beforeGrid'=>'My fancy content before.',
        'afterGrid'=>'My fancy content after.',
    ],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
    ],
        // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
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
