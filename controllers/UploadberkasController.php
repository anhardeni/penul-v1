<?php

namespace app\controllers;

use Yii;
use app\models\Uploadberkas;
use app\models\UploadberkasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UploadberkasController implements the CRUD actions for Uploadberkas model.
 */
class UploadberkasController extends Controller
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
     * Lists all Uploadberkas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadberkasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Uploadberkas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    

     public function actionCreate()
    {
        $model = new Uploadberkas();
 
        if ($model->load(Yii::$app->request->post())) {
          $image = UploadedFile::getInstance($model, 'image');
           if (!is_null($image)) {
             $model->src_filename = $image->name;
             $ext = end((explode(".", $image->name)));
              // generate a unique file name to prevent duplicate filenames
              $model->web_filename = Yii::$app->security->generateRandomString().".{$ext}";
              // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)                       
              Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
              $path = Yii::$app->params['uploadPath'] . $model->web_filename;
               $image->saveAs($path);
            }
            if ($model->save()) {             
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
     * Updates an existing Uploadberkas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post())) {
          $image = UploadedFile::getInstance($model, 'image');
           if (!is_null($image)) {
             $model->src_filename = $image->name;
             $ext = end((explode(".", $image->name)));
              // generate a unique file name to prevent duplicate filenames
              $model->web_filename = Yii::$app->security->generateRandomString().".{$ext}";
              // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)                       
              Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
              $path = Yii::$app->params['uploadPath'] . $model->web_filename;
               $image->saveAs($path);
            }
            if ($model->save()) {             
                return $this->redirect(['view', 'id' => $model->id]);             
            }  else {
                var_dump ($model->getErrors()); die();
             }
              }
              return $this->render('create', [
                  'model' => $model,
              ]);
    }

    
    public function actionDownload($id) 
    { 
        // $download = Uploadberkas::findOne($id); 
        // $path=Yii::getAlias('@web').'/'.$download->web_filename;

        $model = $this->findModel($id);
        //$path=Yii::getAlias('@web').'/uploads/'.$model->web_filename;
        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
        $path = Yii::$app->params['uploadPath'] . $model->web_filename;

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        } else {
           // throw new NotFoundHttpException("can't find {$download->web_filename} file");
            throw new NotFoundHttpException("can't find {$model->web_filename} file");
        }
    }


    /**
     * Deletes an existing Uploadberkas model.
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

    public function getImageurl()
    {
      return \Yii::getAlias('@app/web').'/'.$this->web_filename;
    }

    /**
     * Finds the Uploadberkas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Uploadberkas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Uploadberkas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
