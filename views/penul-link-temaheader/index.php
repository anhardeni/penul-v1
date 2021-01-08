<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
//use kartik\select2\Select2;
//use kartik\grid\GridView;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            //'link_tema',
            //'link_header',
'keyword_specific',
'dap_rha:ntext',

 [
     'attribute' => 'created_by', 
       'value' => 'user.username'
       

//     'width' => '200px',
//     'value' => function ($model, $key, $index, $widget) { 
//         return $model->user->username;
//     },
//     'filterType' => GridView::FILTER_SELECT2,
//     'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'), 
//     'filterWidgetOptions' => [
//         'pluginOptions' => ['allowClear' => true],
//     ],
//     'filterInputOptions' => ['placeholder' => 'username']
 ],

 


// [
//     'attribute' => 'created_by',
//     'filter' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->orderBy('id')->asArray()->all(), 'id','name'),
//     'filterType' => GridView::\kartik\widgets\Select2::classname(),
//     'filterWidgetOptions' => [
//         'options' => ['prompt' => ''],
//         'pluginOptions' => [
//             'allowClear' => true,
//             'width'=>'resolve'
//         ],
//     ],
// ],
            // 'dap_rha2:ntext',
            // 'dap_rha3:ntext',
            // 'dap_rha4',
            // 'dap_rha5:ntext',
            // 'dap_rha6:ntext',
            // 'dap_rha7:ntext',
            // 'data_pib',
            // 'data_gambar',
            // 'data_gambar_filename',
            // 'data_pib_filename',
            // 'periode_tarik_data',
            // 'link_upload_berkas',
            // 'ket',
            // 'created_at',
              // 'created_by',
            // 'updated_by',
            // 'updated_at',

['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
  'update','delete','view'],$this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\controllers\PenulLinkTemaheaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Penul Link Temaheader';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-link-temaheader-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))){ ?>        <?=  Html::a('Penul Link Temaheader Baru', ['create'], ['class' => 'btn btn-success']) ?>
    <?php } ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,      
    ]); ?>
    <?php Pjax::end(); ?>
</div>
