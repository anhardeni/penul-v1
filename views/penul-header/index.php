<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
//use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;

$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
['attribute' => 'id','label'=> 'ref-id'],
'noagenda',
            //'jen_dok',
           // 'jen_pelanggaran',
            //'kesimpulan_rha_jum_pt',
            // 'kesimpulan_rha_nilaipotensi',
            //'analisa_prosedur_rha',
            // 'kesimpulan_laop',
// [ 
//     'attribute' =>  'penyaji_data1',
// 'filter' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->orderBy('id')->asArray()->all(), 'id','name')
// ], 
// [
//  'attribute' => 'penyaji_data1', 
//   'value' => 'penyajiData1.name'
// ],

[
    'attribute' => 'penyaji_data1',
    'label' => 'Penyaji data1',
    'value' => function($model){
                    return $model->getPenyajiData1Name();//getPenyajiData1Name()
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'penyaji', 'id' => 'grid--penyaji_data1']
            ],
           //  'penyaji_data1',
            // 'analis1',
            // 'analis2',
            // 'analis3',
            // 'nd',
            // 'nd_tgl',
            'rha',
            'rha_tgl',

         //    [
         //     'attribute' => 'updated_by', 
         //     'value' => 'user.username'
         // ],

         [
    'attribute' => 'updated_by',
    'label' => 'updated_by',
        'value' => 'user.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->asArray()->all(), 'id','username'),
                'filterWidgetOptions' => [
                 'pluginOptions' => ['allowClear' => true],
             ],
             'filterInputOptions' => ['placeholder' => 'username', 'id' => 'grid--username']
        ],
            // 'npp',
            // 'npp_tgl',
            // 'st',
            // 'st_tgl',
            // 'nhpu',
            // 'nhpu_tgl',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
          'view'],$this->context->route),    ],    ];


         /* @var $this yii\web\View */
         /* @var $searchModel app\controllers\PenulHeaderiSearch */
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
