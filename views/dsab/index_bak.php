<?php

use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Dropdown;

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

        ['class' => 'app\widgets\grid\ActionColumn',  'template' => Mimin::filterActionColumn([
              'update','delete','view'], $this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\models\DsabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Dsab';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="dsab-index">

    <h1><?= Html::encode($this->title) ?></h1>

   

<?= ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'exportConfig' => [
        ExportMenu::FORMAT_TEXT => false,
        ExportMenu::FORMAT_HTML => false,
        ExportMenu::FORMAT_EXCEL => false,
        ExportMenu::FORMAT_PDF => [
            'pdfConfig' => [
                'methods' => [
                    'SetTitle' => 'DSAB',
                    'SetSubject' => 'Generating PDF files via yii2-export extension has never been easy',
                    'SetHeader' => ['Krajee Library Export||Generated On: ' . date("r")],
                    'SetFooter' => ['|Page {PAGENO}|'],
                   // 'SetAuthor' => Yii=>user=NAME,
                    'SetCreator' => 'Kartik Visweswaran',
                    'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, GridView, Grid, yii2-grid, yii2-mpdf, yii2-export',
                ]
            ]
        ],
    ],
    
    'dropdownOptions' => [
                    'label' => 'Export All',
                    'class' => 'btn btn-danger'
                ]
        ]);
        ?>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>  
        <?=  Html::a('Dsab Baru', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>

    

    


    <?= GridView::widget([
       'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        
    ]); ?>
    <?php Pjax::end(); ?>
</div>
