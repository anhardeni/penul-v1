<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            'tema',
            'key_word',
            'hs_awal',
            'hs_akhir',
            // 'tarif_akhir',
            // 'cara_tarik_datanya',
            // 'analisa',
            // 'referensi',
            // 'hint_1',
            // 'hint_2',
            // 'hint_3',
            // 'periode',
            // 'created_at',
            // 'created_by',
            // 'updated_by',
            // 'updated_at',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'view'],$this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\controllers\PenulTemaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Penul Tema';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-tema-index">

   
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>        <?=  Html::a('Penul Tema Baru', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,      
    ]); ?>
    <?php Pjax::end(); ?>
</div>
