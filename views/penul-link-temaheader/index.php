<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
//use app\widgets\grid\GridView;
use yii\widgets\Pjax;
//use kartik\select2\Select2;
use kartik\grid\GridView;

$gridColumns=[
    ['class' => 'yii\grid\SerialColumn'], 
    ['attribute' => 'id','label'=> 'ref-id-drilling'],


            //'link_tema',
// [
//      'attribute' => 'link_tema', 
//        'value' => 'penul_tema.tema'
//        ],

    // [
    //     'attribute' => 'link_tema',
    //     'label' => 'Tema',
    //     'value' => function($model){
    //                 return $model->getLinkTemaName();//getPenyajiData1Name()
    //             },
    //             'filterType' => GridView::FILTER_SELECT2,
    //             'filter' => \yii\helpers\ArrayHelper::map(\app\models\PenulTema::find()->asArray()->all(), 'id','tema'),
    //             'filterWidgetOptions' => [
    //              'pluginOptions' => ['allowClear' => true],
    //          ],
    //          'filterInputOptions' => ['placeholder' => 'tema', 'id' => 'grid--link_tema']
    //      ],

    [
        'attribute' => 'link_tema',
        'label' => 'Tema',
            'value' => 'penul-tema.tema',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\PenulTema::find()->asArray()->all(), 'id','tema'),
                'filterWidgetOptions' => [
                 'pluginOptions' => ['allowClear' => true],
             ],
             'filterInputOptions' => ['placeholder' => 'tema', 'id' => 'grid--link_tema']
         ],

            //'link_header',
         'keyword_specific',
         'dap_rha:ntext',

         // [
         //     'attribute' => 'created_by', 
         //     'value' => 'user.username'

         // ],




[
    'attribute' => 'created_by',
    'label' => 'created_by',
        'value' => 'user.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->asArray()->all(), 'id','username'),
                'filterWidgetOptions' => [
                 'pluginOptions' => ['allowClear' => true],
             ],
             'filterInputOptions' => ['placeholder' => 'username', 'id' => 'grid--username']
        ],

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
          'view'],$this->context->route),    ],  
     ];


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
