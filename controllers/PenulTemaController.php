<?php

namespace app\controllers;

use Yii;
use app\models\PenulTema;
use app\controllers\PenulTemaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PenulLinkTemaheader;
use app\controllers\PenulLinkTemaheaderSearch;

/**
 * PenulTemaController implements the CRUD actions for PenulTema model.
 */
class PenulTemaController extends Controller
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
     * Lists all PenulTema models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenulTemaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenulTema model.
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
     * Creates a new PenulTema model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PenulTema();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PenulTema model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PenulTema model.
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
     * Finds the PenulTema model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenulTema the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenulTema::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



        public function actionAddcreatedetail($id)
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


return $this->render('view', [
            'model' => $this->findModel($id),
        ]);   
}
}
