<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;


$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            'noagenda',
            'nd',
            'nd_tgl',
            'rha',
            // 'rha_tgl',
            // 'perusahaan',
            // 'pib',
            // 'tglpib',
            // 'seri_brg',
            // 'keputusan_npp',
            // 'fpkeputusan_NPP',
            // 'fpket_NPP',
            // 'laop',
            // 'laop_tgl',
            // 'kkp',
            // 'kkp_tgl',
            // 'npp',
            // 'npp_tgl',
            // 'st',
            // 'st_tgl',
            // 'pfpd',
            // 'nhpu',
            // 'nhpu_tgl',
            // 'spktnp',
            // 'spktnp_tgl',
            // 'bm',
            // 'bmad',
            // 'bmi',
            // 'bmdp',
            // 'ppn',
            // 'pph',
            // 'denda',
            // 'total_tagihan',
            // 'spktnp_jthtempo',
            // 'sspcp',
            // 'sspcp_tgl',
            // 'ntb',
            // 'ntpn',
            // 'status_akhir_banding',
            // 'npp_rha_gab_1npp',
            // 'npp_tgl_rha_gab_1npp',
            // 'st_rha_gab_1npp',
            // 'st_tgl_rha_gab_1npp',
            // 'nhpu_rha_gab_1npp',
            // 'nhpu_tgl_rha_gab_1npp',
            // 'kasi',
            // 'kabid',
            // 'analis1',
            // 'analis2',
            // 'analis3',
            // 'penyaji_data1',
            // 'ket_risalah',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'],$this->context->route),    ],    ];


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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,      
    ]); ?>
</div>
