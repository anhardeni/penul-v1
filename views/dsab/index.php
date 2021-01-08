<?php

use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;
//use yii\bootstrap4\Modal;
use yii\bootstrap4\Dropdown;
use kartik\icons\FontAwesomeAsset;
//use kartik\bs4dropdown\ButtonDropdown;
?>



<?php
$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
'tim_secondment',
'nama_wp',

                //'npwp',
'kpp',
                // 'kanwil',
                // 'dsab_nondsab',
                // 'status',
                // 'rencana_tindaklanjut',
'earlycalculation_sekber',
'nilai_potensi',
'realisasi',
'gappotensi_dan_realisasi',
'hal_yg_perlu_dieskalasi',
'keterangan',
'status_pemeriksaan',
'follow_up',
                // 'created_at',
                // 'updated_at',
                // 'created_by',
                // 'updated_by',
                // 'showPageSummary' => true,

['class' => 'app\widgets\grid\ActionColumn',  'template' => Mimin::filterActionColumn([
  'update','delete','view'], $this->context->route),    ], 
];

echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'export' => true,
    'target' => ExportMenu::TARGET_SELF,
    'fontAwesome' => true,
     // 'exportConfig' => [
     //     ExportMenu::FORMAT_TEXT => false,
     //    ExportMenu::FORMAT_HTML => false,
     //     ExportMenu::FORMAT_EXCEL => true,
     //     ExportMenu::FORMAT_PDF => true,
     //     ExportMenu::FORMAT_CSV => true,
     // ],
    
  // 'asDropdown' => true, 
    
    'dropdownOptions' => [
        'label' => 'Export All',
        'class' => 'btn btn-danger'
    ]
]
);

/* @var $this yii\web\View */
/* @var $searchModel app\models\DsabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Dsab';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="dsab-index">


    <h1><?= Html::encode($this->title) ?></h1>

    




    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create")))
    { ?>  
        <?=  Html::a('Dsab Baru', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>    </p>

        
        <?=  Html::a('cetak kool', ['report'], ['class' => 'btn btn-warning']) ?>
        <?php  ?>    

        

        


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
        //'export' => true,
         //'floatHeader' => true,
            'rowOptions'=>function($model){
                if($model->hal_yg_perlu_dieskalasi =='Selesai')
                    {return ['class'=>'success'];}
                else{
                    if($model->hal_yg_perlu_dieskalasi =='Proses Analisa')
                        {return ['class'=>'danger'];}
                }
            },
            'columns' => $gridColumns, 
            
            


            

            
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
