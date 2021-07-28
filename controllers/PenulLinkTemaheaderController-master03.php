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
use app\models\PenulDatatransakTh;
use app\models\Uploadberkas;
use app\models\PenulTema;
use yii\helpers\ArrayHelper;
use yii\db\Transaction;
use yii\db\Query;
use yii\db\Command;
use yii\db\Connection;
use yii\data\ActiveDataProvider;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

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

  // https://yii2-cookbook-test.readthedocs.io/working-with-multiple-records/

    {
      $model = new PenulLinkTemaheader();
      $modelsPenulDatatransaksTh = [new PenulDatatransaksTh];



      if ($model->load(Yii::$app->request->post())) {





      //  $modelsPenulDatatransaksTh = Model::createMultiple(PenulDatatransaksTh::classname());
      //  Model::loadMultiple($modelsPenulDatatransaksTh, Yii::$app->request->post());

        // validate all models
        $valid = $model->validate();
        $valid = Model::validateMultiple($modelsPenulDatatransaks) && $valid;
        $image1a = UploadedFile::getInstance($model, 'image1a');
        $file1a = UploadedFile::getInstance($model, 'file1a');


         if ($valid) {
          $transaction = \Yii::$app->db->beginTransaction();

          try {
            if ($flag = $model->save(false)) {
              foreach ($modelsPenulDatatransaksTh as $modelPenulDatatransaksTh) {
                $modelPenulDatatransaksTh->link_header_th = $model->id;
                if (! ($flag = $modelPenulDatatransakth->save(false))) {
                  $transaction->rollBack();
                  break;
                }
              }
            }

            if ($flag) {
              $transaction->commit();
            //  return $this->redirect(['view', 'id' => $model->id]);
            }
          } catch (Exception $e) {
            $transaction->rollBack();
          }
     
         }


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



       if ($model->save()) {    
            //var_dump ($model->data_gambar_filename); die();         
        return $this->redirect(['view', 'id' => $model->id]);             
      }  else {
        var_dump ($model->getErrors()); die();
      }
    }
    return $this->render('create', [
      'model' => $model,
       'modelsPenulDatatransaksTh' => (empty($modelsPenulDatatransaksTh)) ? [new PenulDatatransaksTh] : $modelsPenulDatatransaks
    ]);     
  }

}




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
         'penyaji_data1' =>  $model->created_by,
         'analis1'=> 4,
         'analisa_prosedur_rha' => $model->dap_rha,
         'analisa_prosedur_rha2' => $model->dap_rha2,
         'analisa_prosedur_rha3' => $model->dap_rha3,
         'analisa_prosedur_rha4' => $model->dap_rha4,
         'analisa_prosedur_rha5' => $model->dap_rha5,
         'analisa_prosedur_rha6' => $model->dap_rha6,
         'analisa_prosedur_rha7' => $model->dap_rha7,
         'datagambar_filename' =>  $model->data_gambar_filename,
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

    public function actionUpload3detilth($id)
    {
      //$query = New Query();
     $query = \app\models\PenulDatatransaksTh::find()->where(['link_header_th' => $id]);
      // $query = \app\models\PenulDatatransaks::find();

     $dataProvider = new ActiveDataProvider([
          //'query' => $query->from ('penul_datatransaks')->where(['link_header' => $id]),
      'query' => $query,
      'sort' => [
        'defaultOrder' => [
          'id' => SORT_DESC
        ]
      ],
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
          $model = new PenuldatatransaksTh();
          $model->link_header = $id;
          $model->npwp_imp = (string)$sheetData[$baseRow]['B']; 
          $model->imp = (string)$sheetData[$baseRow]['C'];
          $model->pib = (string)$sheetData[$baseRow]['D'];
              // $tgl9= (string)$sheetData[$baseRow]['E'];
          $newformat = date('Y-m-d',strtotime((string)$sheetData[$baseRow]['E']));
          $model->tglpib = $newformat ;
          $model->seri_brg = (string)$sheetData[$baseRow]['F'];
          $model->kdskepfas = (string)$sheetData[$baseRow]['G'];
          $model->uraian_brg = (string)$sheetData[$baseRow]['H'];
          $model->hs = (string)$sheetData[$baseRow]['I'];
          $model->hs_t = (string)$sheetData[$baseRow]['J']; 
          $model->trf_bm = (float)$sheetData[$baseRow]['K'];
          $model->trf_bm_t = (float)$sheetData[$baseRow]['L'];
          $model->nilaipabean_awal = (double)$sheetData[$baseRow]['M'];
          $model->bm_nilai_awal = (float)$sheetData[$baseRow]['N'];
          $model->ppn_nilai_awal = (float)$sheetData[$baseRow]['R'];
          $model->pph_nilai_awal = (float)$sheetData[$baseRow]['U'];
          $model->nilaipabean_akhir = (double)$sheetData[$baseRow]['Y'];
          $model->trf_ppn_t = (float)$sheetData[$baseRow]['Z'];
          $model->trf_pph_t = (float)$sheetData[$baseRow]['AA'];
          $model->trf_ppn = (float)$sheetData[$baseRow]['AB'];
          $model->trf_pph = (float)$sheetData[$baseRow]['AC'];
          $model->trf_ppnbm = (float)$sheetData[$baseRow]['AD'];
          $model->trf_ppnbm_t = (float)$sheetData[$baseRow]['AE'];
          $model->trf_bmad = (float)$sheetData[$baseRow]['AF'];
          $model->trf_bmad_t = (float)$sheetData[$baseRow]['AG'];
          $model->trf_bk = (float)$sheetData[$baseRow]['AH'];
          $model->trf_bk_t = (float)$sheetData[$baseRow]['AI'];
          $model->bk_nilai_awal = (float)$sheetData[$baseRow]['AJ'];
          $model->bk_nilai_akhir = (float)$sheetData[$baseRow]['AK'];


        

         // $model->bm_t_nilai_akhir =(
         //  ((float)$sheetData[$baseRow]['L'] - (float)$sheetData[$baseRow]['K']) * (float)$sheetData[$baseRow]['M'] ;
         // if trf_bm = 0 then  $model->nilaipabean_akhir = $model->nilaipabean_awal
         // else
         // hanya salah tarif BM


           //   $model->nilaipabean_akhir = ($model->nilaipabean_awal);
         // selisih BM , PPN dan pph
             //  if (($model->nilaipabean_awal) > 1   ){
          $model->bm_t_nilai_akhir = 
          (float)(($model->trf_bm_t/100 *  $model->nilaipabean_akhir)- ($model->trf_bm/100 *  $model->nilaipabean_awal));

           //   }else{ 
           // $model->bm_t_nilai_akhir = 0 ; // potensi ppn
          //};


          if (($model->ppn_nilai_awal) > 1   ){
              $model->ppn_t_nilai_akhir = (float)(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) * $model->trf_ppn_t/100 ) - $model->ppn_nilai_awal); // potensi ppn

          //     return $path ;
            }else{ 
            $model->ppn_t_nilai_akhir = 0 ; // potensi ppn
          };

              // $model->ppn_t_nilai_akhir = (float)(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) *  $model->trf_ppn_t/100 ) - $model->ppn_nilai_awal); // potensi ppn


          if (($model->pph_nilai_awal) > 1  ){
          $model->pph_t_nilai_akhir = (float)(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) * $model->trf_pph_t/100 )- $model->pph_nilai_awal); // potensi pph
          
          //     return $path ;
        }else{ 
            $model->pph_t_nilai_akhir = 0 ; // potensi ppn
          };

         
          $model->total_tagihan = floor($model->bm_t_nilai_akhir +  $model->ppn_t_nilai_akhir + $model->pph_t_nilai_akhir);

         

          $model->created_at = date('Y-m-d H:i:s');
          $model->created_by = Yii::$app->user->identity->id ;
          $model->updated_at = date('Y-m-d H:i:s');
          $model->updated_by = Yii::$app->user->identity->id ;

            // if (($model->nilaipabean_awal) > $model->nilaipabean_akhir )(die());
            // if (($model->ppn_nilai_awal) > $model->ppn_t_nilai_akhir )(die());
            // if (($model->pph_nilai_awal) > $model->pph_t_nilai_akhir )(die());
          //     return $path ;



           // die( ) ;
          $model->save();
          $baseRow++;
        }
        Yii::$app->getSession()->setFlash('success', 'Success');
      // echo $baseRow;
      // var_dump($model->trf_bm_t);
       // var_dump($model->pph_t_nilai_akhir);
       // die( ) ;
      }
      else{
        Yii::$app->getSession()->setFlash('error', 'Error');
      }
    }

    return $this->render('upload3detilth',[
      'modelImport' => $modelImport,
      'dataProvider' => $dataProvider,

    ]);

  }


  public function actionUpload2gbr($id)
    {
        $model = new Uploadberkas();
        

      //  Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
    //  $path = Yii::$app->params['uploadPath'] . $model->web_filename;
 
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

            $names = UploadedFile::getInstances($model,'web_filename');
            Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';

            foreach($names as $name){
                   $path = Yii::$app->params['uploadPath'].md5($name->baseName).'.'.$name->extension;
                  //$path = Yii::$app->security->generateRandomString().'.'.$name->extension;
                
               if($name->saveAs($path)){
                 $filename = $name->baseName.'.'.$name->extension;
               //  $filepath = $path ;
                   $filepath = md5($name->baseName).'.'.$name->extension; 
                    //$filepath = md5($name->baseName).'.'.$name->extension; 

                 
                 Yii::$app->db->createCommand()->insert('uploadberkas',['link_gambar'=> $id,'src_filename'=>$filename, 'web_filename'=>$filepath])->execute();
                 // https://www.youtube.com/watch?v=_4VRsrK5ZPU        
                                }
                            }
               ;
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('upload2gbr', [
                'model' => $model,
           


            ]);
        }
    }


}
