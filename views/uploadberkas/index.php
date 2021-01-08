<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            'id_berkas',
            'no_dok',
            'tgl_dok',
            'ket',
             'src_filename',
            // 'web_filename',
            // 'created_at',
            // 'updated_at',
            // 'created_by',

        // [ 'class' => 'yii\grid\ActionColumn', ],
        // ['attribute'=>'Download',
        // 'format'=>'raw',
        // 'value' => function($data)
        // {
        // return
        // Html::a('Download file', ['uploadberkas/download', 'id' => $data->id],['class' => 'btn btn-primary']);
        //   } ],

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'],$this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\models\UploadberkasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Uploadberkas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadberkas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>        <?=  Html::a('Uploadberkas Baru', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,      
    ]); ?>
    <?php Pjax::end(); ?>
</div>
