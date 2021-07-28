<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \stkevich\ckeditor5\EditorClassic;
use kartik\file\FileInput;

use kidzen\dynamicform\DynamicFormWidget;
//use \itstructure\CKEditor;
//use \itstructure\ckeditor\CKEditorAsset;

/* @var $this yii\web\View */
/* @var $model app\models\PenulLinkTemaheader */
/* @var $form yii\widgets\ActiveForm */





$js2 = '
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
   jQuery(".dynamicform_wrapper .panel-title-PenulDatatransaksTh").each(function(index) {
       jQuery(this).html("PenulDatatransaksTh: " + (index + 1))
       });
       });

       jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
           jQuery(".dynamicform_wrapper .panel-title-PenulDatatransaksTh").each(function(index) {
               jQuery(this).html("PenulDatatransaksTh: " + (index + 1))
               });
               });
               ';



               $this->registerJs($js2);



?>

<div class="penul-link-temaheader-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'link_tema')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulTema::find()->orderBy('id')->asArray()->all(), 'id','tema'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>

    <?= $form->field($model, 'link_header')->textInput() ?>


    <?= $form->field($model, 'keyword_specific')->textInput(['maxlength' => true]) ?>

   <div class="col-sm-6">
    <?= $form->field($model, 'dap_rha')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'imageUpload', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/penul-link-temaheader/upfile',
                ]
            ) ?>
            </div>
            <label>Latar Belakang</label>
    <?= $form->field($model, 'dap_rha2')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '',
                ]
            ) ?>


      <label>Identifikasi Permasalahan</label> 
    <?= $form->field($model, 'dap_rha3')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
    <?= $form->field($model, 'dap_rha4')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
    <label>Identifikasi Barang</label>
    <?= $form->field($model, 'dap_rha5')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>


    <label>Penetapan HS Code</label>
    <?= $form->field($model, 'dap_rha6')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>

    <?= $form->field($model, 'dap_rha7')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
      

    
    
<?= $form->field($model, 'file1a')->widget(FileInput::classname(), [
              'options' => ['accept' => '*/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['xls','xlsx','pdf'],'showUpload' => false,],
          ]);   ?>

   
    <?= $form->field($model, 'image1a')->widget(FileInput::classname(), [
              // 'attribute' => 'image1a[]',
             //  'options' => ['multiple'=>true, 'accept' => 'image/*'],
               'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','gif','jpeg','pdf','png'],
                'showUpload' => false,
               // 'maxFileCount'=> 6,
                'overwriteInitial'=>false,
            ]
          ]);   ?> 


  
   

    <?= $form->field($model, 'periode_tarik_data')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl',
                                    'autoclose' => true
                                ]
                            ],
                        ]); ?>

    <?= $form->field($model, 'link_upload_berkas')->textInput() ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>


    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsPenulDatatransaksTh[0],
        'formId' => 'dynamic-form01',
        'formFields' => [
 //* @property string|null $flag_pusat
 //* @property string|null $flag_pusat_ket
            'kode_kantor',
            'pib',
            'tglpib',
            'seri_brg',
            'npwp_imp',
            'imp',
            'uraian_brg',
            'hs_t',
            'trf_bm_t',
            'bm_t_nilai_akhir',
            'hs',
            'trf_bm',
            //'kurs
            'bm_nilai_awal',
            'ppn_nilai_awal',
            'ppn_t_nilai_akhir',
            'pph_nilai_awal',
            'pph_t_nilai_akhir',
            'ppnbm_t_nilai_akhir',
            'nilaipabean_awal',
            'nilaipabean_akhir',
            'denda',
            'total_tagihan',
            'ket',
        ],
    ]); ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Data RHA Penul
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add pib</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($modelsPenulDatatransaksTh as $index => $modelPenulDatatransaksTh): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-PenulDatatransaksTh">PenulDatatransaksTh: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                        if (!$modelPenulDatatransaksTh->isNewRecord) {
                            echo Html::activeHiddenInput($modelPenulDatatransaksTh, "[{$index}]id");
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($modelPenulDatatransaksTh, "[{$index}]flag_pusat")->dropDownList([ 'setuju' => 'Setuju', 'tolak ada SPKTNP' => 'Tolak ada SPKTNP', 'tolak sedang Audit' => 'Tolak sedang Audit', ], ['prompt' => ''])->hint('Update sesuai Keputusan NPP'); ?>
                            </div>


                            <div class="row">
                                <?= $form->field($modelPenulDatatransaksTh, "[{$index}]flag_pusat_ket")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-2">
                                <?= $form->field($modelPenulDatatransaksTh, "[{$index}]npp_no")->textInput(['maxlength' => true])->hint('diisi jika ada RHA digabung jadi 1 NPP') ?>
                            </div>

                            <div class="col-sm-2">
                                <?= $form->field($modelPenulDatatransaksTh, "[{$index}]npp_tgl")->widget(\kartik\datecontrol\DateControl::classname(), [
                                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                    'saveFormat' => 'php:Y-m-d',
                                    'ajaxConversion' => FALSE,
                                    'options' => [
                                        'pluginOptions' => [
                                            'placeholder' => 'klik pilih tgl NPP ',
                                            'autoclose' => true
                                        ]
                                    ],
                                ]);?>
                            </div>
                            
                        </div>

                        <div class="row">
                          <div class="col-sm-2">
                            <?= $form->field($modelPenulDatatransaksTh, "[{$index}]st_no")->textInput(['maxlength' => true])->hint('diisi jika ada RHA digabung jadi 1 NPP') ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($modelPenulDatatransaksTh, "[{$index}]st_tgl")->widget(\kartik\datecontrol\DateControl::classname(), [
                                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                'saveFormat' => 'php:Y-m-d',
                                'ajaxConversion' => FALSE,
                                'options' => [
                                    'pluginOptions' => [
                                        'placeholder' => 'klik pilih tgl ST',
                                        'autoclose' => true
                                    ]
                                ],
                            ]);?>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-2">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]nhpu_no")->textInput(['maxlength' => true])->hint('diisi jika ada RHA digabung jadi 1 NPP') ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]nhpu_tgl")->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl ST',
                                    'autoclose' => true
                                ]
                            ],
                        ]);?>
                    </div>
                </div>


                <div class="row">

                    <div class="col-sm-3">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]pib")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]tglpib")->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl ND',
                                    'autoclose' => true
                                ]
                            ],
                        ]);?>
                    </div>

                    <div class="col-sm-3">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]seri_brg")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]uraian_brg")->textInput(['maxlength' => true]) ?>
                    </div>
                </div><!-- end:row -->

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]npwp_imp")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]imp")->textInput(['maxlength' => true]) ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]hs")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]hs_t")->textInput(['maxlength' => true]) ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]trf_bm")->textInput() ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]trf_bm_t")->textInput() ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]bm_nilai_awal")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]bm_t_nilai_akhir")->textInput() ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]nilaipabean_awal")->textInput() ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]nilaipabean_akhir")->textInput() ?>
                    </div>

                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]ppn_nilai_awal")->textInput() ?>
                    </div>
                    

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]ppn_t_nilai_akhir")->textInput() ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]pph_nilai_awal")->textInput() ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]pph_t_nilai_akhir")->textInput() ?>
                    </div>

                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksTh, "[{$index}]denda")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaksThTh, "[{$index}]total_tagihan")->textInput() ?>
                    </div>
                </div>


            </div><!-- end:row -->
        </div>
    </div>
<?php endforeach; ?>

<div class="panel-heading">
    <i class="fa fa-envelope" aria-hidden="true"></i> Data Penul
    <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
    <div class="clearfix"></div>
</div>
</div>
</div>
<?php DynamicFormWidget::end(); ?>

    
  

    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>


  <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
