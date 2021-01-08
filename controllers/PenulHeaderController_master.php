<?php

namespace app\controllers;

use Yii;
use app\models\PenulHeader;
use app\models\PenulHeaderQuery;
use app\controllers\PenulHeaderSearch;
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
 * PenulHeaderController implements the CRUD actions for PenulHeader model.
 */
class PenulHeaderController extends Controller
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
        $searchModel = new PenulHeaderSearch();
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

    
    public function actionCreate()
    {
      $model = new PenulHeader;
      $modelsPenulDatatransaks = [new PenulDatatransaks];


      if ($model->load(Yii::$app->request->post()) ) {


        $modelsPenulDatatransaks = Model::createMultiple(PenulDatatransaks::classname());
        Model::loadMultiple($modelsPenulDatatransaks, Yii::$app->request->post());

            // validate all models
        $valid = $model->validate();
        $valid = Model::validateMultiple($modelsPenulDatatransaks) && $valid;

        if ($valid) {
          $transaction = \Yii::$app->db->beginTransaction();

          try {
            if ($flag = $model->save(false)) {
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

      return $this->render('create', [
        'model' => $model,
        'modelsPenulDatatransaks' => (empty($modelsPenulDatatransaks)) ? [new PenulDatatransaks] : $modelsPenulDatatransaks
      ]);
    }



    /**
     * Updates an existing PenulHeader model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // 

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
            'modelsPenulDatatransaks' => (empty($modelsPenulDatatransaks)) ? [new PenulDatatransaks] : $modelsPenulDatatransaks
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


 public function actionImportdata($id)
 {
    $dataProvider = new ActiveDataProvider([
            'query' => PenulDummydatatransaks::find(),
        ]);


    $modelImport = new \yii\base\DynamicModel([
    'fileImport' => 'File Import',
  ]);
  $modelImport->addRule(['fileImport'], 'required');
  $modelImport->addRule(['fileImport'], 'file', ['extensions'=>'xls,xlsx'],['maxSize'=>100240*100240]);

  if (Yii::$app->request->post()) {
    $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
    if ($modelImport->fileImport && $modelImport->validate()) {
      $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName );
      $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
      $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
      $baseRow = 2;
      while(!empty($sheetData[$baseRow]['A'])){
        $model = new PenulDummydatatransaks();
        $model->link_header = $id;
         $model->npwp_imp = (string)$sheetData[$baseRow]['B']; 
         $model->imp = (string)$sheetData[$baseRow]['C'];
         $model->pib = (string)$sheetData[$baseRow]['D'];
        // ok $model->tglpib = substr((string)$sheetData[$baseRow]['E'],6,4);
         // $tglx0 = (string)$sheetData[$baseRow]['E'];
         // $pieces = explode(" ", $tglx0);
         // echo $pieces[0]; // piece1
         //echo $pieces[1]; // piece2
          //echo $pieces[2]; // piece2
         // $piece4 = trim((string)("$pieces[0] $pieces[1] $pieces[2]"));
         // $tglx1= (strtotime($tgl_tt0));
         // $tglx2= date($tglx1);

         // $tgl_tt1 = substr((string)$sheetData[$baseRow]['E'],7,2);
         // $tgl_tt2 = substr((string)$sheetData[$baseRow]['E'],3,3);
         // $tgl_tt3 = substr((string)$sheetData[$baseRow]['E'],0,2);
       // $tgl_tt4 = ("$tgl_tt1-$tgl_tt2-$tgl_tt3");

         //$time = strtotime('$tgl_tt4');
         $tgl9= (string)$sheetData[$baseRow]['E'];
         $newformat = date('Y-m-d',strtotime($tgl9));
         // $model->tglpib = date('Y-m-d',(strtotime($sheetData[$baseRow]['E']);
        // ok $model->tglpib = date('Y-m-d',(string)$sheetData[$baseRow]['E']);

         // $tgl_tt0 = (string)$sheetData[$baseRow]['E'];
         // $model->tglpib = date('Y-m-d',($tgl_tt0));
         $model->tglpib = $newformat ;
         $model->seri_brg = (string)$sheetData[$baseRow]['F'];

           //var_dump($tgl9);
           //var_dump($tgl_tt4);
           //var_dump($time);
           // var_dump($newformat);  
           // var_dump('tglpib');
           // die();
          


        // $tgl_tt1 = substr((string)$sheetData[$baseRow]['G'],6,4);
        // $tgl_tt2 = substr((string)$sheetData[$baseRow]['G'],3,2);
        // $tgl_tt3 = substr((string)$sheetData[$baseRow]['G'],0,2);
        // $tgl_tt4 = ("$tgl_tt1 $tgl_tt2 20$tgl_tt3");
        //   $tgl_tt5 = (string)$sheetData[$baseRow]['G'];
         

      //    ->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE__YYYYMMDD2);
        // $model->tglpib = (string)$sheetData[$baseRow]['G'];

         $model->created_at = date('Y-m-d H:i:s');
         $model->created_by = Yii::$app->user->identity->id ;

        // $model->pib = (string)$sheetData[$baseRow]['D'];
        // $model->seri_brg = (string)$sheetData[$baseRow]['F'];
        // $model->pib = (string)$sheetData[$baseRow]['D'];
        // $model->pib = (string)$sheetData[$baseRow]['D'];
        
        // $tgl_tt1 = substr((string)$sheetData[$baseRow]['P'],6,4);
        // $tgl_tt2 = substr((string)$sheetData[$baseRow]['P'],3,2);
        // $tgl_tt3 = substr((string)$sheetData[$baseRow]['P'],0,2);
        // $tgl_tt4 = ("$tgl_tt1-$tgl_tt2-$tgl_tt3");
        // $model->tgl_tt = $tgl_tt4;



       // belajar dari utphala 
        // $model->tgl_tt = date( );

    //  $model->tgl_tt = substr((string)$sheetData[$baseRow]['P'],0,10);
        // $model->jam_tt = substr((string)$sheetData[$baseRow]['P'],11,8);
        // $model->importir = (string)$sheetData[$baseRow]['D'];
        // $model->no_pib = (string)$sheetData[$baseRow]['A'];

        // $tgl11 = substr((string)$sheetData[$baseRow]['B'],6,4);
        // $tgl12 = substr((string)$sheetData[$baseRow]['B'],3,2);
        // $tgl13 = substr((string)$sheetData[$baseRow]['B'],0,2);
        // $tgl14 = ("$tgl11-$tgl12-$tgl13");
        // $model->tgl_pib = $tgl14;

      //$model->tgl_pib = (string)$sheetData[$baseRow]['B'];
        // $model->pfpd = (string)$sheetData[$baseRow]['N'];
        // $model->nip_pfpd = (string)$sheetData[$baseRow]['G'];
        // $model->nm_terima = (string)$sheetData[$baseRow]['W'];
        // // $nip1 = Yii::$app->user->identity->nip;
        
        //        // $model1 = (string)$sheetData[$baseRow]['P'];

        // if ((string)$sheetData[$baseRow]['T'] == "MK")(  $model ->jalur = "Kuning");
        // if ((string)$sheetData[$baseRow]['T'] == "MH")(  $model ->jalur = "Merah");
        // if ((string)$sheetData[$baseRow]['T'] == "MA")(  $model ->jalur = "Merah");
        // if ((string)$sheetData[$baseRow]['T'] == "MM")(  $model ->jalur = "Merah");
         //if ((string)$sheetData[$baseRow]['P'] = "MM")( $model ->jalur = "Merah");
         //$model::DataPokok22()::findOne(no_pib)
      //  $model->status_brg = "1";

              // $model->tgl_tt = (string)$sheetData[$baseRow]['P'];
           //  var_dump($tgl_tt0); 
           // var_dump($sheetData[$baseRow]['E']); 
           //  var_dump($piece4);
           //  var_dump($tgl_tt4);
           // //  var_dump($tglx2);
           //  var_dump($time);
           //    var_dump($newformat);  die();
             
        $model->save();
        $baseRow++;
      }

      Yii::$app->getSession()->setFlash('success', 'Success');
    }
    else{
      Yii::$app->getSession()->setFlash('error', 'Error');
    }
  }

  return $this->render('importdata',[
    'modelImport' => $modelImport,
    'dataProvider' => $dataProvider,

  ]);

}

public function actionPindahdata()
{

  $connection = Yii::$app->db;
  $sql1 = "INSERT IGNORE data_pokok SELECT * FROM data_pokok22 WHERE NOT EXISTS (  SELECT * FROM data_pokok WHERE  data_pokok.no_pib = data_pokok22.no_pib  AND data_pokok.tgl_pib = data_pokok22.tgl_pib )";
   //$sql2 = "data_pokok22";
  $transaction = $connection->beginTransaction();


  try {
   $connection->createCommand($sql1)->execute();
   $connection->createCommand()->truncateTable('data_pokok22')->execute();

   $transaction->commit();
 } catch(\Exception $e) {
  $transaction->rollBack();
  throw $e;
} catch(\Throwable $e) {
  $transaction->rollBack();
  throw $e;
}

/*
    $connection = Yii::$app->db2;
    //$connection->createCommand('INSERT data_pokokmaster SELECT * FROM data_pokok22 WHERE id_data != id_data ')
     $connection->createCommand('INSERT IGNORE data_pokok SELECT * FROM data_pokok22 WHERE NOT EXISTS (  SELECT * FROM data_pokok WHERE  data_pokok.no_pib = data_pokok22.no_pib AND data_pokok.tgl_pib = data_pokok22.tgl_pib )')
    ->bindValue(':no_pib', $no_pib)
    ->execute();

  */

    echo "success";
    return $this->redirect(['index']);
  }


    /**
     * Deletes an existing DataPokok22 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionKosongdata()

    {
  //  $models = DataPokok22::find()->all();
  //  foreach ($models as $model) {
  //  $model->delete();

      $connection = Yii::$app->db;
      $connection->createCommand()->truncateTable('data_pokok22')->execute();

      echo " data temporary telah dikosongkan";
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
