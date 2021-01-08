<?php

namespace app\controllers;

use Yii;
use app\models\PenulHeader;
use app\controllers\PenulAdminSearch;
use app\models\PenulHeaderQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use app\models\PenulDatatransaks;
use app\models\PenulDummydatatransaks;
use app\models\PenulUraianAnalisa;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\db\Transaction;
use yii\db\Query;
use yii\db\Command;
use yii\db\Connection;
use yii\data\ActiveDataProvider;

/**
 * PenulAdminController implements the CRUD actions for PenulHeader model.
 */
class PenulAdminController extends Controller
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
     * Lists all PenulHeader models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenulAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenulHeader model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsPenulDatatransaks = $model->penulDatatransaks;

       

        return $this->render('view', [
            'model' => $model,
            'modelsPenulDatatransaks' => (empty($modelsPenulDatatransaks)) ? [new PenulDatatransaks] : $modelsPenulDatatransaks
        ]);
    }

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsPenulDatatransaks = $model->penulDatatransaks;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPenulDatatransaks, 'id', 'id');
            $modelsPenulDatatransaks = Model::createMultiple(PenulDatatransaks::classname(), $modelsPenulDatatransaks);
            Model::loadMultiple($modelsPenulDatatransaks, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPenulDatatransaks, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPenulDatatransaks) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            PenulDatatransaks::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPenulDatatransaks as $modelPenulDatatransaks) {
                             $modelPenulDatatransaks->link_header = $model->id;
                            if (! ($flag = $modelPenulDatatransaks->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsPenulDatatransaks' => (empty($modelsPenulDatatransaks)) ? [new PenulDatatransaks] : $modelsPenulDatatransaks1
        ]);
    }

    /**
     * Deletes an existing PenulHeader model.
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
     * Finds the PenulHeader model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenulHeader the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenulHeader::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
