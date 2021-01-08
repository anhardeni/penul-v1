<?php


use yii\helpers\Html;

use yii\widgets\ActiveForm;

use app\modules\course\models\CourseCategories;

use app\modules\course\models\Courses;

use app\modules\instructor\models\Instructors;

use yii\helpers\ArrayHelper;

use mihaildev\ckeditor\CKEditor;

use yii\jui\DatePicker;

use kartik\widgets\Select2;

use yii\helpers\Url;

use kartik\file\FileInput;

use wbraganca\dynamicform\DynamicFormWidget;

 //course_file_path

/* @var $this yii\web\View */

/* @var $model app\models\Course */

/* @var $form yii\widgets\ActiveForm */


if(Yii::$app->controller->action->id == 'create')

	$label = 'Add';

else

	$label = 'Update';

?>


<div class="col-xs-12 col-lg-12">

	<div class="<?php echo $model->isNewRecord ? 'box-success' : 'box-info'; ?> box view-item col-xs-12 col-lg-12">

		<div class="academic-programme-form">

		    <?php $form = ActiveForm::begin([

					'id' => 'dynamic-form',

                                        'options'=>['enctype'=>'multipart/form-data'],

					'enableAjaxValidation' => true,

					'fieldConfig' => [

					    'template' => "{label}{input}{error}",

					],

		    ]); ?>




<!-- GENERAL DETAILS -->

<div class="box box-info">   

  <div class="box-header with-border">

    <h3 class="box-title">General</h3>

      <div class="box-tools pull-right">

        <button type="button" class="btn btn-info" data-widget="collapse"><i class="fa fa-minus"></i></button> 

<!--        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->

      </div>

  </div>

  <!-- /.box-header -->

  <div class="box-body">

    <div class="table-responsive">  

    <div class="col-xs-12 col-lg-12 no-padding">  

        <div class="col-xs-12 col-sm-8 col-lg-8">    

            <?= $form->field($model, 'course_name')->textInput(['maxlength' => 200]) ?>

        </div>

        <div class="col-xs-12 col-sm-4 col-lg-4">

            <?= $form->field($model, 'course_code')->textInput(['maxlength' => 100]) ?>

        </div>

    </div>    

    <div class="col-xs-12 col-lg-12 no-padding"> 

        <div class="col-xs-12 col-sm-4 col-lg-4">

                            <?= $form->field($model, 'course_faculty_id')->dropDownList(ArrayHelper::map(app\models\Faculties::find()->where(['is_status' => 0])->all(),'faculty_id','faculty_name'),

                            [

                                'prompt'=>Yii::t('course', '--- Select Faculty ---'),

                                'onchange'=>'

                                    $.get( "'.Url::toRoute('dependent/coursedepartment').'", { id: $(this).val() } )

                                        .done(function( data ) {

                                            $( "#'.Html::getInputId($model, 'course_department_id').'" ).html( data );

                                        }

                                    );

                                '    

                            ]); ?>

        </div>

        <div class="col-xs-12 col-sm-4 col-lg-4">

                            <?php echo $form->field($model,'course_department_id')->dropDownList([],

                                        [

                                            'prompt'=>Yii::t('app', '--- Select Department ---'),

                                            'onchange'=>'

                                                $.get( "'.Url::toRoute('dependent/courseprogramme').'", { id: $(this).val() } )

                                                    .done(function( data ) {

                                                        $( "#'.Html::getInputId($model, 'course_programme_id').'" ).html( data );

                                                    }

                                                );'    

                                        ]		

                                                ); 

                            ?>  


        </div>

        <div class="col-xs-12 col-sm-4 col-lg-4">

            <?php echo $form->field($model,'course_programme_id')->dropDownList([''=>Yii::t('app', '--- Select Programme ---')]); ?>

        </div>

    </div>

    <div class="col-xs-12 col-lg-12 no-padding">

    	<div class="col-xs-12 col-sm-4 col-lg-4">

                            <?= $form->field($model, 'course_academic_year_id')->dropDownList(ArrayHelper::map(\app\models\AcademicYears::find()->where(['is_status' => 0])->all(),'academic_year_id','academic_year_name'),

                            [

                                    'prompt'=>Yii::t('course', '--- Select Academic Year ---'),

                                    'onchange'=>'

                                        $.get( "'.Url::toRoute('dependent/coursesemester').'", { id: $(this).val() } )

                                            .done(function( data ) {

                                                $( "#'.Html::getInputId($model, 'course_academic_semester_id').'" ).html( data );

                                            }

                                        );'    

                                ]       

                            );   ?>                

    	</div>                        

    	<div class="col-xs-12 col-sm-4 col-lg-4">

                            <?php if(isset($model->course_academic_semester_id)) { ?>


                                <?= $form->field($model, 'course_academic_semester_id',['inputOptions'=>[ 'class'=>'form-control'] ])->dropDownList(ArrayHelper::map(\app\models\AcademicSemesters::find(['academic_semester_id' => $model->course_academic_semester_id])->where(['is_status' => 0])->all(),'academic_semester_id','semester_name'),['prompt'=>Yii::t('course', '--- Select Academic Semester ---')]);  ?>

                            <?php } else {   ?>

                                <?= $form->field($model, 'course_academic_semester_id',['inputOptions'=>[ 'class'=>'form-control'] ])->dropDownList(['prompt'=>Yii::t('course', '--- Select Academic Semester ---')]);  ?>

                            <?php } ?>

    	</div>  

    	<div class="col-xs-12 col-sm-4 col-lg-4">

            <?= $form->field($model, 'course_type')->dropDownList($model->getCourseType(),['prompt'=>'Select Course Type']) ?>              

    	</div>          

    </div>     

                 

    </div>

  </div>  

</div> 


<!-- DESCRIPTION -->

<div class="box box-success">   

  <div class="box-header with-border">

    <h3 class="box-title">Description</h3>

      <div class="box-tools pull-right">

        <button type="button" class="btn btn-success" data-widget="collapse"><i class="fa fa-minus"></i></button> 

        <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->

      </div>

  </div>

  <!-- /.box-header -->

  <div class="box-body">

    <div class="table-responsive">        


    <div class="col-xs-12 col-lg-12 no-padding">

      <div class="col-xs-12 col-sm-12 col-lg-12"> 

      <?= $form->field($model, 'course_summary')->widget(CKEditor::className(),[

          'editorOptions' => [

              'rows' => 4,

              'preset' => 'full', 

              'inline' => false, 

              'clientOptions' => [

              'filebrowserBrowseUrl' => ''

              ]              

          ],

      ]); ?>

      </div>


    </div>

    

    </div>

  </div>  

</div> 


<!-- FORMAT -->

<div class="box box-danger">   

  <div class="box-header with-border">

    <h3 class="box-title">Format</h3>

      <div class="box-tools pull-right">

        <button type="button" class="btn btn-danger" data-widget="collapse"><i class="fa fa-minus"></i></button> 

        <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->

      </div>

  </div>


  <div class="box-body">

    <div class="table-responsive">        


      <div class="col-xs-12 col-lg-12 no-padding"> 

        <div class="col-xs-12 col-sm-4 col-lg-4">

          <?= $form->field($model, 'course_format')->dropDownList($model->getCourseFormat(),['prompt'=>'Select Course Format']) ?>

        </div>  


        <div class="col-xs-12 col-sm-4 col-lg-4">

            <?= $form->field($model, 'course_unit')->textInput(['maxlength' => 1]) ?>

        </div>            

      </div>

      <div class="col-xs-12 col-lg-12 no-padding topic-data"> 

        <div class="col-xs-12 col-sm-12 col-lg-12">

        

        </div>    

      </div>       

      <div class="col-xs-12 col-lg-12 no-padding weekly-data"> 

        <div class="col-xs-12 col-sm-12 col-lg-12">

            <?= $form->field($model, 'course_start_date')->widget(yii\jui\DatePicker::className(),

                            [

                              'clientOptions' => [

                                  'dateFormat' => 'dd-mm-yyyy',

                                  'changeMonth' => true,

                                  'changeYear' => true,

                                  'autoSize' => true ],

                              'options'=> [

                'class' => 'form-control',

                'placeholder' =>  Yii::t('app', 'Select Date'),

              ]

            ]) ?>         

        </div>    

      </div>        

        

    </div>

  </div>  

</div>


<!-- FORMAT -->

<div class="box box-info">   

  <div class="box-header with-border">

    <h3 class="box-title">Content</h3>

      <div class="box-tools pull-right">

        <button type="button" class="btn btn-info" data-widget="collapse"><i class="fa fa-minus"></i></button> 

        <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->

      </div>

  </div>


  <div class="box-body">

    <div class="table-responsive">        


      <div class="col-xs-12 col-lg-12 no-padding"> 


    <div class="col-xs-12 col-sm-12 col-lg-12">

      <?= $form->field($model, 'coursefile[]')->widget(FileInput::classname(), [

    'options'=>['accept' => 'image/*', 'multiple'=>true]]

) ?>

    </div>


      </div>

    </div>

  </div>  

</div>


<!-- FORMAT -->

<div class="box box-success">   

  <div class="box-header with-border">

    <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Course Instructors</h3>

      <div class="box-tools pull-right">

        <button type="button" class="btn btn-success" data-widget="collapse"><i class="fa fa-minus"></i></button> 

        <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->

      </div>

  </div>

<!--   /.box-header -->

  <div class="box-body">

    <div class="table-responsive">  

        

        

<!--    <div class="row">

    	<div class="panel panel-default">

	        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Po Items</h4></div>

	        <div class="panel-body">-->

	             <?php DynamicFormWidget::begin([

	                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

	                'widgetBody' => '.container-items', // required: css class selector

	                'widgetItem' => '.item', // required: css class

	                'limit' => 4, // the maximum times, an element can be cloned (default 999)

	                'min' => 1, // 0 or 1 (default 1)

	                'insertButton' => '.add-item', // css class

	                'deleteButton' => '.remove-item', // css class

	                'model' => $modelsCourseInstructors[0],

	                'formId' => 'dynamic-form',

	                'formFields' => [

	                    'instructor_id',

	                    'remark'

	                ],

	            ]); ?>        

        


	            <div class="container-items"><!-- widgetContainer -->

	            <?php foreach ($modelsCourseInstructors as $i => $modelCourseInstructors): ?>

	                <div class="item panel panel-default"><!-- widgetBody -->

	                    <div class="panel-heading">

	                        <h3 class="panel-title pull-left">Add More Course Instructors</h3>

	                        <div class="pull-right">

	                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>

	                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>

	                        </div>

	                        <div class="clearfix"></div>

	                    </div>

	                    <div class="panel-body">

	                        <?php

                            // necessary for update action.

                            if (! $modelCourseInstructors->isNewRecord) {

                                echo Html::activeHiddenInput($modelCourseInstructors, "[{$i}]course_instructor_id");

                            }

	                        ?>

	                        <div class="row">

	                            <div class="col-sm-6">                                      

                                        <?= $form->field($modelCourseInstructors, "[{$i}]instructor_id")->widget(Select2::classname(), [

                                            'data' => ArrayHelper::map(app\modules\instructor\models\Instructors::find()->where(['is_status'=>0])->all(),'instructor_id','instructorFullName'),

                                            'language' => 'en',

                                            'options' => ['placeholder' => 'Select Course Instructor ...',

                                            ],

                                         //   'disabled'=>'true',

                                            'pluginOptions' => [

                                                'allowClear' => true

                                            ],

                                        ]); ?>                                        

                                        

	                            </div>

	                            <div class="col-sm-6">

	                                <?= $form->field($modelCourseInstructors, "[{$i}]remark")->textInput(['maxlength' => 100]) ?>

	                            </div>

	                        </div><!-- .row -->

	                    </div>

	                </div>

	            <?php endforeach; ?>           

        </div>

          

      </div>

        <?php DynamicFormWidget::end(); ?>

    </div>

  </div>  

</div>

<!--</div>-->

                    

    		<div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding jkklmsArLangCss">

				<div class="col-xs-6">

        			<?= Html::submitButton($model->isNewRecord ? Yii::t('course', 'Create') : Yii::t('course', 'Update'), ['class' => $model->isNewRecord  ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>

				</div>

				<div class="col-xs-6">

					<?= Html::a(Yii::t('course', 'Cancel'), ['index'], ['class' => 'btn btn-default btn-block']) ?>

				</div>

    		</div>

    		<?php ActiveForm::end(); ?>

		</div>

	</div>

</div>