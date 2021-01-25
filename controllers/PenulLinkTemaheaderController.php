<?php

namespace app\controllers;

use Yii;
use app\models\PenulLinkTemaheader;
use app\controllers\PenulLinkTemaheaderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\PenulHeader;
use app\model\User;
use yii\db\Expressions;

/**
 * PenulLinkTemaheaderController implements the CRUD actions for PenulLinkTemaheader model.
 */
class PenulLinkTemaheaderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
      return [
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'delete' => ['POST'],
          ],
        ],
      ];
    }

    /**
     * Lists all PenulLinkTemaheader models.
     * @return mixed
     */
    public function actionIndex()
    {
      $searchModel = new PenulLinkTemaheaderSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
      ]);
    }

    /**
     * Displays a single PenulLinkTemaheader model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      return $this->render('view', [
        'model' => $this->findModel($id),
      ]);
    }

    /**
     * Creates a new PenulLinkTemaheader model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
      $model = new PenulLinkTemaheader();

      if ($model->load(Yii::$app->request->post())) {
        $image1a = UploadedFile::getInstance($model, 'image1a');
        $file1a = UploadedFile::getInstance($model, 'file1a');

        if ((!is_null($image1a)) and (!is_null($file1a))) {
         $model->data_gambar = $image1a->name;
         $model->data_pib = $file1a->name;

         $ext = end((explode(".", $image1a->name)));
         $ext1 = end((explode(".", $file1a->name)));

              // generate a unique file name to prevent duplicate filenames
         $model->data_gambar_filename = Yii::$app->security->generateRandomString().".{$ext}";
         $model->data_pib_filename = Yii::$app->security->generateRandomString().".{$ext1}";
              // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)                       
         Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';

         $path = Yii::$app->params['uploadPath'] . $model->data_gambar_filename;
         $path1 = Yii::$app->params['uploadPath'] . $model->data_pib_filename;

         $image1a->saveAs($path);
         $file1a->saveAs($path1);

       }
       if ($model->save()) {    
            //var_dump ($model->data_gambar_filename); die();         
        return $this->redirect(['view', 'id' => $model->id]);             
      }  else {
        var_dump ($model->getErrors()); die();
      }
    }
    return $this->render('create', [
      'model' => $model,
    ]);     
  }

    /**
     * Updates an existing PenulLinkTemaheader model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);
      $old_file1a = $model->data_pib_filename;
      $old_file = $model->data_gambar_filename;

      if ($model->load(Yii::$app->request->post())) {
        $image1a = UploadedFile::getInstance($model, 'image1a');
        $file1a = UploadedFile::getInstance($model, 'file1a');

        if ((!is_null($image1a)) And (!is_null($file1a))) {

          $model->data_pib = $file1a->name;
          $ext1 = end((explode(".", $file1a->name)));
          $model->data_pib_filename = Yii::$app->security->generateRandomString().".{$ext1}";
          Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
          $path1 = Yii::$app->params['uploadPath'] . $model->data_pib_filename;
          $file1a->saveAs($path1);


          $model->data_gambar = $image1a->name;
          $ext = end((explode(".", $image1a->name)));
          $model->data_gambar_filename = Yii::$app->security->generateRandomString().".{$ext}";
              // generate a unique file name to prevent duplicate filenames
             // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)                       
          $path = Yii::$app->params['uploadPath'] . $model->data_gambar_filename;
          $image1a->saveAs($path);

          if (empty($model->data_pib_filename)){
           $model->data_pib_filename = $old_file1a;
         }

         if (empty($model->data_gambar_filename)){
           $model->data_gambar_filename = $old_file;
         }

//var_dump ($model->data_gambar_filename); die(); 
       }
       if ($model->save()) {    
            //var_dump ($model->data_gambar_filename); die();         
        return $this->redirect(['view', 'id' => $model->id]);             
      }  else {
        var_dump ($model->getErrors()); die();
      }
    }
    return $this->render('create', [
      'model' => $model,
    ]);     ;     
  }






  public function actionDownloaddatapib($id) 
  { 
        // $download = Uploadberkas::findOne($id); 
        // $path=Yii::getAlias('@web').'/'.$download->web_filename;

    $model = $this->findModel($id);
        //$path=Yii::getAlias('@web').'/uploads/'.$model->web_filename;
    Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
    $path = Yii::$app->params['uploadPath'] . $model->data_pib_filename;

    if (file_exists($path)) {
      return Yii::$app->response->sendFile($path);
    } else {
           // throw new NotFoundHttpException("can't find {$download->web_filename} file");
      throw new NotFoundHttpException("can't find {$model->data_pib_filename} file");
    }
  }
    /**
     * Deletes an existing PenulLinkTemaheader model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

     try
     {
      $this->findModel($id)->delete();

    }
    catch(\yii\db\IntegrityException  $e)
    {
     Yii::$app->session->setFlash('error', "Data Tidak Dapat Dihapus Karena Dipakai Modul Lain");
   } 
   return $this->redirect(['index']);
 }

    /**
     * Finds the PenulLinkTemaheader model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenulLinkTemaheader the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
      if (($model = PenulLinkTemaheader::findOne($id)) !== null) {
        return $model;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }


    public function actionCopydraftrha($id)
    {
  //  $models = DataPokok22::find()->all();
  //  foreach ($models as $model) {
  //  $model->delete();

      $model = $this->findModel($id);
      $modelsPenulHeader = new PenulHeader();

       Yii::$app->db->createCommand()->upsert('penul_header', 
         [
         'jen_dok' => 1,
         'jen_pelanggaran' => 1, // url is unique
          'penyaji_data1' =>  Yii::$app->user->identity->id,
          'analis1'=> 4,
          'analisa_prosedur_rha' => $model->dap_rha,
          'analisa_prosedur_rha2' => $model->dap_rha2,
          'analisa_prosedur_rha3' => $model->dap_rha3,
          'analisa_prosedur_rha4' => $model->dap_rha4,
          'analisa_prosedur_rha5' => $model->dap_rha5,
          'analisa_prosedur_rha6' => $model->dap_rha6,
          'analisa_prosedur_rha7' => $model->dap_rha7,
                  ], 
      //  // [  'visits' => new \yii\db\Expression('visits + 1'),    ]
         $params)->execute();

      // $connection = Yii::$app->db;
      // $connection->createCommand()->truncateTable('data_pokok22')->execute();

      // var_dump($model->dap_rha);
      // die;

      echo " data telah dicopy ke header rha";
      return $this->redirect(['index']);

    }


public function actionCopylinktema($id)
    {
  //  $models = DataPokok22::find()->all();
  //  foreach ($models as $model) {
  //  $model->delete();

      $model = $this->findModel($id);
      $modelsPenulHeader = new PenullinkTemaheader();

       Yii::$app->db->createCommand()->upsert('penul_link_temaheader', 
         [
         
          'dap_rha' => $model->dap_rha,
          'dap_rha2' => $model->dap_rha2,
          'dap_rha3' => $model->dap_rha3,
          'dap_rha4' => $model->dap_rha4,
          'dap_rha5' => $model->dap_rha5,
          'dap_rha6' => $model->dap_rha6,
          'dap_rha7' => $model->dap_rha7,
          'created_at'=> Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
          'created_by'=> Yii::$app->user->identity->id,
                  ], 
      //  // [  'visits' => new \yii\db\Expression('visits + 1'),    ]
         $params)->execute();

      // $connection = Yii::$app->db;
      // $connection->createCommand()->truncateTable('data_pokok22')->execute();

      // var_dump($model->dap_rha);
      // die;

      echo " data telah dicopy ke header rha";
      return $this->redirect(['index']);
    }




  }
