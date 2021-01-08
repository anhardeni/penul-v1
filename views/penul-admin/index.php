<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            'noagenda',
            'jen_dok',
            'jen_pelanggaran',
            'analisa_prosedur_rha:ntext',
            // 'analisa_prosedur_rha2:ntext',
            // 'analisa_prosedur_rha3:ntext',
            // 'analisa_prosedur_rha4:ntext',
            // 'analisa_prosedur_rha5:ntext',
            // 'analisa_prosedur_rha6:ntext',
            // 'analisa_prosedur_rha7:ntext',
            // 'kesimpulan_rha_jum_pt',
            // 'kesimpulan_rha_nilaipotensi',
            // 'kesimpulan_laop',
            // 'penyaji_data1',
            // 'penyaji_data2',
            // 'analis1',
            // 'analis2',
            // 'analis3',
            // 'nd',
            // 'nd_tgl',
            // 'rha',
            // 'rha_tgl',
            // 'npp',
            // 'npp_tgl',
            // 'keputusan_npp',
            // 'st',
            // 'st_tgl',
            // 'nhpu',
            // 'nhpu_tgl',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'],$this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\controllers\PenulAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Penul Header';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-header-index">

   
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>        <?=  Html::a('Penul Header Baru', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,      
    ]); ?>
    <?php Pjax::end(); ?>
</div>
