<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use \stkevich\ckeditor5\EditorClassic;

/* @var $this yii\web\View */
/* @var $model app\models\PenulHeader */
/* @var $form yii\widgets\ActiveForm */
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

<div class="penul-admin-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'noagenda')->textInput(['maxlength' => 10]) ?>
                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'jen_dok')->textInput() ?>
                    </div>
                    <div class="col-sm-4">

                        <?= $form->field($model, 'jen_pelanggaran')->textInput() ?>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-4">
                        <?= $form->field($model, 'penyaji_data1')->textInput() ?>
               

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

                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'analis1')->textInput() ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($model, 'analis2')->textInput() ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($model, 'analis3')->textInput() ?>
                        </div>
                    </div>
                
                <div class="row">

                    <div class="col-sm-4">
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
                        <?= $form->field($model, 'rha')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-sm-2">
                        <?= $form->field($model, 'rha_tgl')->textInput() ?>
                    </div>

                    <div class="col-sm-2">
                        <?= $form->field($model, 'npp')->textInput() ?>

                    </div>


                </div>
            </div>  

            <div class="row">
                <div class="col-sm-6">
                        <?= $form->field($model, 'kesimpulan_laop')->textInput(['maxlength' => true]) ?>
                    </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'npp_tgl')->textInput() ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'st')->textInput() ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'st_tgl')->textInput() ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'nhpu')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'nhpu_tgl')->textInput(['maxlength' => true]) ?>
                </div>

            </div>    


                   <div class="padding-v-md">
                <div class="line line-dashed"></div>
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
                            <?= $form->field($modelPenulDatatransaks, "[{$index}]kode_kantor")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]pib")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]tglpib")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                        </div><!-- end:row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]npwp_imp")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]imp")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]seri_brg")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]uraian_brg")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]hs")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]hs_t")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]trf_bm")->textInput() ?>
                            </div>
                            
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]trf_bm_t")->textInput() ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]bm_nilai_awal")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]bm_t_nilai_akhir")->textInput() ?>
                            </div>
                             <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]ppn_t_nilai_akhir")->textInput() ?>
                            </div>
                            
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]pph_t_nilai_akhir")->textInput() ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPenulDatatransaks, "[{$index}]denda")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
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
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
    

</div>
