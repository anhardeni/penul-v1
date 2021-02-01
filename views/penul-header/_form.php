<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use \stkevich\ckeditor5\EditorClassic;

/* @var $this yii\web\View */
/* @var $model app\models\PenulHeader */
/* @var $form yii\widgets\ActiveForm */
/* 
<?php if (Yii::$app->user->can('create-car')): ?>
                        <?= Html::a('Tambah Mobil', ['create'], ['class' => 'btn btn-success']) ?>
<?php else: ?>
                        <li>Your HTML to be rendered when condition is false</li>
<?php endif; ?> 

*/

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
   jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
       jQuery(this).html("PenulDatatransaks: " + (index + 1))
       });
       });

       jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
           jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
               jQuery(this).html("PenulDatatransaks: " + (index + 1))
               });
               });
               ';

               $this->registerJs($js);
               ?>


               <div class="penul-header-form">

                <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'rha')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'rha_tgl')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl ND',
                                    'autoclose' => true
                                ]
                            ],
                        ]); ?>
                    </div>

                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'noagenda')->textInput(['maxlength' => 10]) ?>
                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'jen_dok')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\JenDok::find()->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                    <div class="col-sm-4">

                        <?= $form->field($model, 'jen_pelanggaran')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\JenPelanggaran::find()->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-4">
                        <?= $form->field($model, 'penyaji_data1')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>


                    </div>


                    <div class="col-sm-4">

                        <?= $form->field($model, 'penyaji_data2')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'analis1')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'analis2')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'analis3')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'pfpd')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'kasi')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'kabid')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\PenulAnalisPenyaji::find()->where(['status' => 'active'])->orderBy('id')->asArray()->all(), 'id','name'),
                            'options' => ['placeholder' => 'klik pilih'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                    </div>
                </div>
                
                <div class="row">

                    <div class="col-sm-2">
                        <?= $form->field($model, 'nd')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'nd_tgl')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl ND',
                                    'autoclose' => true
                                ]
                            ],
                        ]); ?>
                    </div>
                </div>

                <div class="row">



                    <div class="col-sm-2">
                        <?= $form->field($model, 'npp')->textInput() ?>

                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'npp_tgl')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl ND',
                                    'autoclose' => true
                                ]
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-2">
                        <?= $form->field($model, 'kkp')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'kkp_tgl')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl KKP',
                                    'autoclose' => true
                                ]
                            ],
                        ]); ?>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-2">
                        <?= $form->field($model, 'laop')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'laop_tgl')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => FALSE,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'klik pilih tgl LAOP',
                                    'autoclose' => true
                                ]
                            ],
                        ]); ?>
                    </div>
                </div>




            </div>  

            <div class="row">

                <div class="col-sm-8">
                    <?= $form->field($model, 'kesimpulan_laop')->textInput(['maxlength' => true])->hint('diisikan: Terdapat .. dokumen .. yang dapat dilakukan penelitian ulang, sedangkan .. dokumen  .. tidak dapat dilakukan penelitian ulang karena ... ') ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'keputusan_npp')->dropDownList(['DAPAT DILAKUKAN PENUL' => 'DAPAT DILAKUKAN PENUL', 'DILAKUKAN PENUL ( SEBAGIAN )' => 'DILAKUKAN PENUL ( SEBAGIAN )', 'TIDAK-DAPAT DILAKUKAN PENUL' => 'TIDAK-DAPAT DILAKUKAN PENUL', ], ['prompt' => '']) ?>
                </div>

                <div class="col-sm-6">
                    <label>Jumlah perusahaan</label>
                    <?= $form->field($model, 'kesimpulan_rha_jum_pt')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-6">
                    <label>Nilai potensi RHA</label>
                    <?= $form->field($model, 'kesimpulan_rha_nilaipotensi')->textInput(['maxlength' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'st')->textInput() ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'st_tgl')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                        'saveFormat' => 'php:Y-m-d',
                        'ajaxConversion' => FALSE,
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => 'klik pilih tgl ND',
                                'autoclose' => true
                            ]
                        ],
                    ]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'nhpu')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'nhpu_tgl')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                        'saveFormat' => 'php:Y-m-d',
                        'ajaxConversion' => FALSE,
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => 'klik pilih tgl ND',
                                'autoclose' => true
                            ]
                        ],
                    ]); ?>
                </div>

            </div>    


            <?= $form->field($model, 'analisa_prosedur_rha')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
            <label>Latar Belakang</label>
            <?= $form->field($model, 'analisa_prosedur_rha2')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
            <label>Identifikasi Permasalahan</label>
            <?= $form->field($model, 'analisa_prosedur_rha3')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
            <?= $form->field($model, 'analisa_prosedur_rha4')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>

            <label>Identifikasi Barang</label>
            <?= $form->field($model, 'analisa_prosedur_rha5')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
            <label>Penetapan HS code</label>
            <?= $form->field($model, 'analisa_prosedur_rha6')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>
            <?= $form->field($model, 'analisa_prosedur_rha7')->widget(EditorClassic::className(), 
                [
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',],
                    'uploadUrl' => '/someUpload.php',
                ]
            ) ?>


            <div class="padding-v-md">
                <div class="line line-dashed"></div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
            </div>

            <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsPenulDatatransaks[0],
        'formId' => 'dynamic-form',
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
            <i class="fa fa-envelope"></i> Data Penul
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add pib</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsPenulDatatransaks as $index => $modelPenulDatatransaks): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">PenulDatatransaks: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                        if (!$modelPenulDatatransaks->isNewRecord) {
                            echo Html::activeHiddenInput($modelPenulDatatransaks, "[{$index}]id");
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]flag_pusat")->dropDownList([ 'setuju' => 'Setuju', 'tolak ada SPKTNP' => 'Tolak ada SPKTNP', 'tolak sedang Audit' => 'Tolak sedang Audit', ], ['prompt' => ''])->hint('Update sesuai Keputusan NPP'); ?>
                            </div>



                            <div class="row">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]flag_pusat_ket")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-2">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]npp_no")->textInput(['maxlength' => true])->hint('diisi jika ada RHA digabung jadi 1 NPP') ?>
                            </div>

                            <div class="col-sm-2">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]npp_tgl")->widget(\kartik\datecontrol\DateControl::classname(), [
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
                            <?= $form->field($modelPenulDatatransaks, "[{$index}]st_no")->textInput(['maxlength' => true])->hint('diisi jika ada RHA digabung jadi 1 NPP') ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($modelPenulDatatransaks, "[{$index}]st_tgl")->widget(\kartik\datecontrol\DateControl::classname(), [
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
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]nhpu_no")->textInput(['maxlength' => true])->hint('diisi jika ada RHA digabung jadi 1 NPP') ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]nhpu_tgl")->widget(\kartik\datecontrol\DateControl::classname(), [
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
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]pib")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]tglpib")->widget(\kartik\datecontrol\DateControl::classname(), [
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
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]seri_brg")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]uraian_brg")->textInput(['maxlength' => true]) ?>
                    </div>
                </div><!-- end:row -->

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]npwp_imp")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]imp")->textInput(['maxlength' => true]) ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]hs")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]hs_t")->textInput(['maxlength' => true]) ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]trf_bm")->textInput() ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]trf_bm_t")->textInput() ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]bm_nilai_awal")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]bm_t_nilai_akhir")->textInput() ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]nilaipabean_awal")->textInput() ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]nilaipabean_akhir")->textInput() ?>
                    </div>

                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]ppn_nilai_awal")->textInput() ?>
                    </div>
                    

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]ppn_t_nilai_akhir")->textInput() ?>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]pph_nilai_awal")->textInput() ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]pph_t_nilai_akhir")->textInput() ?>
                    </div>

                </div>    
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]denda")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPenulDatatransaks, "[{$index}]total_tagihan")->textInput() ?>
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

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
