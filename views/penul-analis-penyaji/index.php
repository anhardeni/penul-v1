<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            'name',
            'nip',
            //'created_by',
            // 'updated_at',
            // 'updated_by',
             'status',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'],$this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\controllers\PenulAnalisPenyajiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Penul Analis Penyaji';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-analis-penyaji-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>        <?=  Html::a('Tambah Analis dan Penyaji', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,      
    ]); ?>
    <?php Pjax::end(); ?>
</div>
