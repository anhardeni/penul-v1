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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
/**
 * PenulHeaderController implements the CRUD actions for PenulHeader model.
 */
class PenulHeaderController extends Controller
{
    //$vowel = array("&nbsp", ";", "â");
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


         // $model->bm_t_nilai_akhir =(
         //  ((float)$sheetData[$baseRow]['L'] - (float)$sheetData[$baseRow]['K']) * (float)$sheetData[$baseRow]['M'] ;
         // if trf_bm = 0 then  $model->nilaipabean_akhir = $model->nilaipabean_awal
         // else
         // hanya salah tarif BM
        $model->nilaipabean_akhir = ($model->nilaipabean_awal);
          // selisih BM , PPN dan pph
        $model->bm_t_nilai_akhir = floor($model->trf_bm_t/100 *  $model->nilaipabean_akhir)- ($model->trf_bm/100 *  $model->nilaipabean_awal) ;
        $model->ppn_t_nilai_akhir = floor(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) / 10) - $model->ppn_nilai_awal);
        $model->pph_t_nilai_akhir = floor(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) / 40 )- $model->pph_nilai_awal);
        $model->total_tagihan = floor($model->bm_t_nilai_akhir +  $model->ppn_t_nilai_akhir + $model->pph_t_nilai_akhir);
         // $model->seri_brg = (string)$sheetData[$baseRow]['O'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['P'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['Q'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['S'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['T'];
        



        $model->created_at = date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->identity->id ;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id ;
        
        $model->save();
        $baseRow++;
      }
      
      Yii::$app->getSession()->setFlash('success', 'Success');
     // echo $baseRow;
      // var_dump($model->trf_bm_t);
      // var_dump($model->nilaipabean_awal);
      // var_dump($model->nilaipabean_akhir);
      //   var_dump($model->bm_t_nilai_akhir);
      //     var_dump($model->ppn_t_nilai_akhir);
      //     var_dump($model->pph_t_nilai_akhir);
      //     var_dump($model->total_tagihan);
      //    die( ) ;
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

public function actionPindahdata($id)
{

 $dataProvider = new ActiveDataProvider([
  'query' => PenulDummydatatransaks::find($id),
]);

 var_dump($dataProvider); die( ) ;

 $connection = Yii::$app->db;
         // $data = $connection->createCommand($query)->queryAll();
 $query = 'SELECT 
 penul_dummydatatransaks.link_header, 
 penul_dummydatatransaks.flag_pusat,
 penul_dummydatatransaks.pib,
 penul_dummydatatransaks.tglpib,
 penul_dummydatatransaks.seri_brg,
 penul_dummydatatransaks.uraian_brg,
 penul_dummydatatransaks.hs,
 penul_dummydatatransaks.trf_bm,
 penul_dummydatatransaks.bm_nilai_awal,
 penul_dummydatatransaks.hs_t,
 penul_dummydatatransaks.trf_bm_t,
 penul_dummydatatransaks.bm_t_nilai_akhir,
 penul_dummydatatransaks.bmbbs_nilai_akhir,
 penul_dummydatatransaks.bmad_nilai_akhir,
 penul_dummydatatransaks.bmdp_nilai_akhir,
 penul_dummydatatransaks.ppn_nilai_awal,
 penul_dummydatatransaks.ppn_t_nilai_akhir,
 penul_dummydatatransaks.ppnbbs_nilai_akhir,
 penul_dummydatatransaks.ppntdp_nilai_akhir,
 penul_dummydatatransaks.pph_nilai_awal,
 penul_dummydatatransaks.pph_t_nilai_akhir,
 penul_dummydatatransaks.pphbbs_nilai_akhir,
 penul_dummydatatransaks.pphdp_nilai_akhir,
 penul_dummydatatransaks.ppnbm_t_nilai_akhir,
 penul_dummydatatransaks.nilaipabean_awal,
 penul_dummydatatransaks.nilaipabean_akhir,
 penul_dummydatatransaks.denda,
 penul_dummydatatransaks.total_tagihan,
 penul_dummydatatransaks.bmi_nilai_akhir,
 penul_dummydatatransaks.bmp_nilai_akhir,
 penul_dummydatatransaks.bk_nilai_akhir FROM penul_dummydatatransaks';

 $data = $connection->createCommand($query)->queryAll();

//var_dump($data=>penul_dummydatatransaks.flag_pusat); die( ) ;
 $insertValues = [
   'pib' => $data->pib
 ];



 var_dump($insertValues); die( ) ;

 $connection->createCommand()->upsert('penuldatatransaks',$insertValues, $params)->execute();

//   $sql1 = "INSERT IGNORE penul_datatransaks 
//   SELECT 
//   penul_dummydatatransaks.link_header, 
//   penul_dummydatatransaks.flag_pusat,
//   penul_dummydatatransaks.pib,
//   penul_dummydatatransaks.tglpib,
//   penul_dummydatatransaks.seri_brg FROM penul_dummydatatransaks WHERE NOT EXISTS ( 
//   SELECT * FROM penul_datatransaks WHERE  
//   penul_datatransaks.pib = penul_dummydatatransaks.pib  
//   AND penul_datatransaks.tglpib = penul_dummydatatransaks.tglpib
//   AND penul_datatransaks.seri_brg = penul_dummydatatransaks.seri_brg
// )";
    //$sql2 = "data_pokok22";
 //var_dump($connection); die( ) ;


// $transaction = $connection->beginTransaction();
// try {
//  $connection->createCommand($sql01)->execute();
//   // $connection->createCommand()->truncateTable('penul_dummydatatransaks')->execute();
// // var_dump($connection); die( ) ;


//  $transaction->commit();
// } catch(\Exception $e) {
//   $transaction->rollBack();
//   throw $e;
// } catch(\Throwable $e) {
//   $transaction->rollBack();
//   throw $e;
// }


//     $connection = Yii::$app->db2;
//     //$connection->createCommand('INSERT data_pokokmaster SELECT * FROM data_pokok22 WHERE id_data != id_data ')
//      $connection->createCommand('INSERT IGNORE data_pokok SELECT * FROM data_pokok22 WHERE NOT EXISTS (  SELECT * FROM data_pokok WHERE  data_pokok.no_pib = data_pokok22.no_pib AND data_pokok.tgl_pib = data_pokok22.tgl_pib )')
//     ->bindValue(':no_pib', $no_pib)
//     ->execute();


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


    public function actionCetakrha($id)
    {
      $ctkPenulHeader = \app\models\PenulHeader::findOne($id);
      $ctkPenulDatatransaks = \app\models\PenulDatatransaks::find()->where (['link_header'=>$ctkPenulHeader->id])->all();
      $ctkAnalisPenyaji1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
      $ctkAnalis1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis1])->one();
      $ctkAnalis2 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis2])->one();
      $ctkAnalis3 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis3])->one();
      $ctkAnalis2ttd = \app\models\PenulAnalisPenyaji::find('web_filename')->where (['id'=>$ctkPenulHeader->analis2])->one();
      $ctkJendok = \app\models\JenDok::find()->where (['id'=>$ctkPenulHeader->jen_dok])->one();
      $ctkJenPelanggaran = \app\models\JenPelanggaran::find()->where (['id'=>$ctkPenulHeader->jen_pelanggaran])->one();


          // Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
         // $path = Yii::$app->params['uploadPath'] . $ctkAnalis2ttd->web_filename;

          // Initalize the TBS instance
          $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
          $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_RHA_v1.xlsx';
          // $template = Yii::getAlias('@web').'/templatepenul/'.'templaterhav1.xlsx';
          //$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
          //$OpenTBS->PlugIn(TBS_AGGREGATE);

           $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
           
if (isset($_POST['debug']) && ($_POST['debug']=='current')) $OpenTBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $OpenTBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $OpenTBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.




$OpenTBS->VarRef['xid']=$ctkPenulHeader -> id;
$OpenTBS->VarRef['xrha']=$ctkPenulHeader -> rha;
$OpenTBS->VarRef['xtglrha']=$ctkPenulHeader -> rha_tgl ;
$OpenTBS->VarRef['xkesimpulan_rha_nilaipotensi']=$ctkPenulHeader -> kesimpulan_rha_nilaipotensi;
$OpenTBS->VarRef['xjendok']= $ctkJendok -> name;
$OpenTBS->VarRef['xjendok1']= $ctkJendok -> name;
$OpenTBS->VarRef['xjendok2']= $ctkJendok -> name;
$OpenTBS->VarRef['xjen_pelanggaran']= $ctkJenPelanggaran -> name;

$vowel = array("&nbsp", ";", "â");
$OpenTBS->VarRef['xanalisa_prosedur_rha']= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha));
$OpenTBS->VarRef['xanalisa_prosedur_rha2']= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha2));
$OpenTBS->VarRef['xanalisa_prosedur_rha3']= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha3));
$OpenTBS->VarRef['xanalisa_prosedur_rha4']= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha4));
$OpenTBS->VarRef['xanalisa_prosedur_rha5']= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha5));
$OpenTBS->VarRef['xanalisa_prosedur_rha6']= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha6));
$OpenTBS->VarRef['xanalisa_prosedur_rha7']= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha7));

$OpenTBS->VarRef['xpenyaji1']=$ctkAnalisPenyaji1 -> name;
$OpenTBS->VarRef['xanalis1']=$ctkAnalis1 -> name;
$OpenTBS->VarRef['xanalis2']=$ctkAnalis2 -> name;
$OpenTBS->VarRef['xanalis3']=$ctkAnalis3 -> name;

$OpenTBS->VarRef['xanalis2ttd']=$ctkAnalis2ttd -> web_filename;
$OpenTBS->VarRef['xfilettd']= $path ;
$OpenTBS->PlugIn(OPENTBS_MERGE_SPECIAL_ITEMS);

$b1 = [];
foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss){
  $b1[] = [
             //'id' => $ctksrtb1 -> id,
   'kode_kantor'=>$ctkPenulDatatransakss-> kode_kantor,
   'pib'=>$ctkPenulDatatransakss-> pib,
   'tglpib'=>$ctkPenulDatatransakss-> tglpib,
   'npwp_imp'=>$ctkPenulDatatransakss-> npwp_imp,
   'imp'=>$ctkPenulDatatransakss-> imp,
   'seri_brg'=>$ctkPenulDatatransakss-> seri_brg,
   'uraian_brg'=>$ctkPenulDatatransakss-> uraian_brg,
   'hs'=>$ctkPenulDatatransakss-> hs,
   'trf_bm'=>$ctkPenulDatatransakss-> trf_bm,
   'bm_nilai_awal'=>$ctkPenulDatatransakss-> bm_nilai_awal,
   'nilaipabean_awal'=>$ctkPenulDatatransakss-> nilaipabean_awal,
   'hs_t'=>$ctkPenulDatatransakss-> hs_t,
   'trf_bm_t'=>$ctkPenulDatatransakss-> trf_bm_t,
   'bm_t_nilai_akhir'=>$ctkPenulDatatransakss-> bm_t_nilai_akhir,
   'nilaipabean_akhir'=>$ctkPenulDatatransakss-> nilaipabean_akhir,
             // 'ppn_nilai_awal'=>$ctkPenulDatatransakss-> ppn_nilai_awal,
             // 'ppn_t_nilai_akhir'=>$ctkPenulDatatransakss-> ppn_t_nilai_akhir,
             // 'pph_nilai_awal'=>$ctkPenulDatatransakss-> pph_nilai_awal,
             // 'pph_t_nilai_akhir'=>$ctkPenulDatatransakss-> pph_t_nilai_akhir,
             // 'ppnbm_t_nilai_akhir'=>$ctkPenulDatatransakss-> ppnbm_t_nilai_akhir,
             // 'denda'=>$ctkPenulDatatransakss-> denda,
             // 'total_tagihan'=>$ctkPenulDatatransakss-> total_tagihan,
             // nilaipabean_awal
             // nilaipabean_akhir


 ];
}       
$OpenTBS->MergeBlock('a1' ,$b1);


$b2 = [];
foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss2){
  $b2[] = [
             //'id' => $ctksrtb1 -> id,
   'kode_kantor'=>$ctkPenulDatatransakss2-> kode_kantor,
   'pib'=>$ctkPenulDatatransakss2-> pib,

   'tglpib'=>$ctkPenulDatatransakss2-> tglpib,
   'npwp_imp'=>$ctkPenulDatatransakss2-> npwp_imp,
   'imp'=>$ctkPenulDatatransakss2-> imp,
   'bm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> bm_t_nilai_akhir,
   'ppn_nilai_awal'=>$ctkPenulDatatransakss2-> ppn_nilai_awal,
   'ppn_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppn_t_nilai_akhir,
   'pph_nilai_awal'=>$ctkPenulDatatransakss2-> pph_nilai_awal,
   'pph_t_nilai_akhir'=>$ctkPenulDatatransakss2-> pph_t_nilai_akhir,
   'ppnbm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppnbm_t_nilai_akhir,
   'denda'=>$ctkPenulDatatransakss2-> denda,
   'total_tagihan'=>$ctkPenulDatatransakss2-> total_tagihan,
 ];
}       
$OpenTBS->MergeBlock('a2' ,$b2);


        // var_dump($unitpenerbits->unit_penerbit_en);
        // var_dump($path);
        // die( ) ;

          // $OpenTBS->Show(OPENTBS_DOWNLOAD, 'rha'.'.xlsx'); // Also merges all [onshow] automatic fields.
ob_start();
$content = ob_get_contents();
ob_end_clean();
         $OpenTBS->Show(OPENTBS_DOWNLOAD, 'rha'.$id.'.xlsx'); // Also merges all [onshow] automatic fields.  
         exit;
       }

       public function actionCetakkkp($id)
       {

        $ctkPenulHeader = \app\models\PenulHeader::findOne($id);
        $ctkPenulDatatransaks = \app\models\PenulDatatransaks::find()->andwhere (['link_header'=>$ctkPenulHeader->id,'flag_pusat' => 'setuju'])->all();
        //$ctkAnalisPenyaji1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
        $ctkPfpd = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->pfpd])->one();
        $ctkKasi = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kasi])->one();
        $ctkKabid = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kabid])->one();
        $ctkPenyajidata1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
        $ctkJendok = \app\models\JenDok::find()->where (['id'=>$ctkPenulHeader->jen_dok])->one();

          // Initalize the TBS instance
          $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
          $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_KertasKerja_v2.xlsx';
          // $template = Yii::getAlias('@web').'/templatepenul/'.'templaterhav1.xlsx';
           $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
           
           $OpenTBS->VarRef['xid']=$ctkPenulHeader -> id;
           $OpenTBS->VarRef['xkkp']=$ctkPenulHeader -> kkp;
           $OpenTBS->VarRef['xtglkkp']=$ctkPenulHeader -> kkp_tgl ;
           $OpenTBS->VarRef['xjendok']= $ctkJendok -> name;
           $OpenTBS->VarRef['xpfpd']=$ctkPfpd -> name;
           $OpenTBS->VarRef['xkasi']=$ctkKasi -> name;
           $OpenTBS->VarRef['xkabid']=$ctkKabid -> name;
           $OpenTBS->VarRef['xpenyajidata1']=$ctkPenyajidata1 -> name;

           $b1 = [];
           foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss){
            $b1[] = [
             //'id' => $ctksrtb1 -> id,
             'kode_kantor'=>$ctkPenulDatatransakss-> kode_kantor,
             'pib'=>$ctkPenulDatatransakss-> pib,
             'tglpib'=>$ctkPenulDatatransakss-> tglpib,
             'npwp_imp'=>$ctkPenulDatatransakss-> npwp_imp,
             'imp'=>$ctkPenulDatatransakss-> imp,
             'seri_brg'=>$ctkPenulDatatransakss-> seri_brg,
             'uraian_brg'=>$ctkPenulDatatransakss-> uraian_brg,
             'hs'=>$ctkPenulDatatransakss-> hs,
             'trf_bm'=>$ctkPenulDatatransakss-> trf_bm,
             'bm_nilai_awal'=>$ctkPenulDatatransakss-> bm_nilai_awal,
             'nilaipabean_awal'=>$ctkPenulDatatransakss-> nilaipabean_awal,
             'hs_t'=>$ctkPenulDatatransakss-> hs_t,
             'trf_bm_t'=>$ctkPenulDatatransakss-> trf_bm_t,
             'bm_t_nilai_akhir'=>$ctkPenulDatatransakss-> bm_t_nilai_akhir,
             'nilaipabean_akhir'=>$ctkPenulDatatransakss-> nilaipabean_akhir,
           ];
         }       
         $OpenTBS->MergeBlock('a1' ,$b1);


         $b2 = [];
         foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss2){
          $b2[] = [
             //'id' => $ctksrtb1 -> id,
           'kode_kantor'=>$ctkPenulDatatransakss2-> kode_kantor,
           'pib'=>$ctkPenulDatatransakss2-> pib,

           'tglpib'=>$ctkPenulDatatransakss2-> tglpib,
           'npwp_imp'=>$ctkPenulDatatransakss2-> npwp_imp,
           'imp'=>$ctkPenulDatatransakss2-> imp,
           'bm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> bm_t_nilai_akhir,
           'ppn_nilai_awal'=>$ctkPenulDatatransakss2-> ppn_nilai_awal,
           'ppn_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppn_t_nilai_akhir,
           'pph_nilai_awal'=>$ctkPenulDatatransakss2-> pph_nilai_awal,
           'pph_t_nilai_akhir'=>$ctkPenulDatatransakss2-> pph_t_nilai_akhir,
           'ppnbm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppnbm_t_nilai_akhir,
           'denda'=>$ctkPenulDatatransakss2-> denda,
           'total_tagihan'=>$ctkPenulDatatransakss2-> total_tagihan,
         ];
       }       
       $OpenTBS->MergeBlock('a2' ,$b2);

      // var_dump(strip_tags($ctkPenulHeader -> analisa_prosedur_rha));
       // var_dump($issuingcountrys->name);
       // var_dump($issuingauthoritiesb1->name_authorities);
      //  var_dump($ctksrt ->jenis_reference);
       //  var_dump($ctkPenulDatatransaks);
       // var_dump($ctkPenulDatatransaks->imp);
       //  die( ) ;

          // $OpenTBS->Show(OPENTBS_DOWNLOAD, 'rha'.'.xlsx'); // Also merges all [onshow] automatic fields.
       ob_start();
       $content = ob_get_contents();
       ob_end_clean();
         $OpenTBS->Show(OPENTBS_DOWNLOAD, 'kkp'.$id.'.xlsx'); // Also merges all [onshow] automatic fields.  
         exit;
        //  //return $this -> reload();
        //  return $ctksrt->renderAjax();
       }

       public function actionCetaknhpu($id)
       {


        $ctkPenulHeader = \app\models\PenulHeader::findOne($id);
        $ctkPenulDatatransaks = \app\models\PenulDatatransaks::find()->andwhere (['link_header'=>$ctkPenulHeader->id,'flag_pusat' => 'setuju'])->all();
        $ctkPenulDatatransaksImp = \app\models\PenulDatatransaks::find()->andwhere (['link_header'=>$ctkPenulHeader->id,'flag_pusat' => 'setuju'])->one();
        $ctkAnalisPenyaji1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
        $ctkPfpd = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->pfpd])->one();
        $ctkKasi = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kasi])->one();
        $ctkKabid = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kabid])->one();
        $ctkJendok = \app\models\JenDok::find()->where (['id'=>$ctkPenulHeader->jen_dok])->one();


        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
            // $path = Yii::$app->params['uploadPath'] . $ctkPfpdttd->web_filename;

          // Initalize the TBS instance
          $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
          //$OpenTBS->Plugin(OPENTBS_PLUGIN);
          $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_NHPU_ver1.docx';
         // $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_NHPU_ver1_sign_ok.docx';// pakai insert  ttdtemplate_NHPU_ver1_sign_ok
          // $template = Yii::getAlias('@web').'/templatepenul/'.'templaterhav1.xlsx';
           $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).

           
           $OpenTBS->VarRef['xid']=$ctkPenulHeader -> id;
           $OpenTBS->VarRef['xnhpu']=$ctkPenulHeader -> nhpu;

           // $formatter = Yii::$app->formatter;
           // $formatter->asDate('2014-01-01', 'long')


           // Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
           // Yii::$app->formatter->asDate('now', 'php:Y-m-d'); 


         //  $OpenTBS->VarRef['xtglnhpu']=format($ctkPenulHeader ->((nhpu_tgl), 'php:dd-mm-yyyy'));
           $nhpu_tgl = $ctkPenulHeader -> nhpu_tgl;
           $OpenTBS->VarRef['xtglnhpu']= Yii::$app->formatter->asDate($nhpu_tgl, 'php:d-m-Y');
           $OpenTBS->VarRef['xnpp']=$ctkPenulHeader -> npp;

           $OpenTBS->VarRef['xst']=$ctkPenulHeader -> st;
           $OpenTBS->VarRef['xtglst']=$ctkPenulHeader -> st_tgl;

           $OpenTBS->VarRef['xrha']=$ctkPenulHeader -> rha;
           $OpenTBS->VarRef['xtglrha']=$ctkPenulHeader -> rha_tgl;

           $OpenTBS->VarRef['xst1']=$ctkPenulHeader -> st;
           $OpenTBS->VarRef['xtglst1']=$ctkPenulHeader -> st_tgl;

           $OpenTBS->VarRef['xlaop']=$ctkPenulHeader -> laop;
           $OpenTBS->VarRef['xtgllaop']=$ctkPenulHeader -> laop_tgl;

           $OpenTBS->VarRef['xkesimpulanlaop']=$ctkPenulHeader -> kesimpulan_laop;
           $OpenTBS->VarRef['xnilaipotensi']=$ctkPenulHeader -> kesimpulan_rha_nilaipotensi;
           $OpenTBS->VarRef['xjumlahpt']=$ctkPenulHeader -> kesimpulan_rha_jum_pt;
           $OpenTBS->VarRef['xpenyaji1']=$ctkAnalisPenyaji1 -> name;
           $OpenTBS->VarRef['xjendok']= $ctkJendok -> name;
           $OpenTBS->VarRef['xjendok1']= $ctkJendok -> name;
           $OpenTBS->VarRef['xpfpd']=$ctkPfpd -> name;
           $OpenTBS->VarRef['xkasi']=$ctkKasi -> name;
           $OpenTBS->VarRef['xkabid']=$ctkKabid -> name;
           $OpenTBS->VarRef['xnippenyaji1']=$ctkAnalisPenyaji1 -> nip;
           $OpenTBS->VarRef['xnippfpd']=$ctkPfpd -> nip;
           $OpenTBS->VarRef['xnipkasi']=$ctkKasi -> nip;
           $OpenTBS->VarRef['xnipkabid']=$ctkKabid -> nip;
           $OpenTBS->VarRef['ximp']=$ctkPenulDatatransaksImp -> imp;
           $OpenTBS->VarRef['ximp1']=$ctkPenulDatatransaksImp -> imp;
           $OpenTBS->VarRef['ximp2']=$ctkPenulDatatransaksImp -> imp;
           $OpenTBS->VarRef['xnpwp']=$ctkPenulDatatransaksImp -> npwp_imp;
           $OpenTBS->VarRef['xnpwp1']=$ctkPenulDatatransaksImp -> npwp_imp;

           // $OpenTBS->VarRef['xpfpdttd']=$ctkPfpdttd -> web_filename;
           // $OpenTBS->VarRef['xfilettd']= $path;
           //$path = $ctkPfpd->andWhere('IS NOT','web_filename',null]);
           $path = $ctkPfpd -> web_filename;
           if (($path ) !== null ){
            $path = $ctkPfpd -> web_filename;
          //     return $path ;

          }else{ 
           $path= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};
          //  $path= '8pcDZZcykyQcfHw-ors6LBH67HN87FdC.jpg';}; //penul-v1

          //    if (($path1 = $ctkKasi -> web_filename) !== null ){
          //     //return $path = $ctkPfpd -> web_filename;
          //     return $path1 ;

          // }else{ 
          //   $path= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};

          //    if (($path3 = $ctkAnalisPenyaji1 -> web_filename) !== null ){
          //     //return $path = $ctkPfpd -> web_filename;
          //     return $path3 ;

          // }else{ 
          //   $path3= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};


         //     if (($path = $ctkPfpd -> web_filename) !== null ) 
         //    or (($ctkKasi -> web_filename) == null ) 
         //    or (($ctkAnalisPenyaji1 -> web_filename) == null )){
          //     return $path;
               //  $path = $ctkPfpd -> web_filename;
            //       $path= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
         // //   $path= '8pcDZZcykyQcfHw-ors6LBH67HN87FdC.jpg';


        //   }else{ 
          //   $path = $ctkPfpd -> web_filename;
         //    $path1 = $ctkKasi -> web_filename;
         //    $path3 = $ctkAnalisPenyaji1 -> web_filename;
          //   };

         //   $path = 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg'};
         //   $path= '8pcDZZcykyQcfHw-ors6LBH67HN87FdC.jpg';};




            // if (($model = PenulHeader::findOne($id)) !== null) {
            //   return $model;
            // } else {
            //   throw new NotFoundHttpException('The requested page does not exist.');
            // }



           $OpenTBS->VarRef['xfilettd']= Yii::$app->params['uploadPath'].$path;  
             // $OpenTBS->VarRef['xfilettd1']= Yii::$app->params['uploadPath'].$path1;  
             // $OpenTBS->VarRef['xfilettd3']= Yii::$app->params['uploadPath'].$path3;  


             //$OpenTBS->VarRef['xfilettd']=trim(Yii::$app->params['uploadPath'].$path);  
             //$OpenTBS->VarRef['xfilettd']= Yii::$app->params['uploadPath'].$ctkPfpd->web_filename;          
            // $OpenTBS->VarRef['xfilettd1']= Yii::$app->params['uploadPath'].$ctkKasi->web_filename;
            // $OpenTBS->VarRef['xfilettd2']= Yii::$app->params['uploadPath'].$ctkKabid->web_filename;
            // $OpenTBS->VarRef['xfilettd3']= Yii::$app->params['uploadPath'].$ctkAnalisPenyaji1->web_filename;

           //$test1 -> strip_tags($ctkPenulHeader -> analisa_prosedur_rha)
           //$OpenTBS->VarRef['xanalisa_prosedur_rha']= $test1;

           $vowel = array("&nbsp", ";", "â");
           $OpenTBS->VarRef['xanalisa_prosedur_rha']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha));
           $OpenTBS->VarRef['xanalisa_prosedur_rha2']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha2));
           $OpenTBS->VarRef['xanalisa_prosedur_rha3']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha3));
           $OpenTBS->VarRef['xanalisa_prosedur_rha4']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha4));
           $OpenTBS->VarRef['xanalisa_prosedur_rha5']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha5));
           $OpenTBS->VarRef['xanalisa_prosedur_rha6']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha6));
           $OpenTBS->VarRef['xanalisa_prosedur_rha7']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha7));
           ;

           $b1 = [];
           foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss){
            $b1[] = [
             //'id' => $ctksrtb1 -> id,
             'kode_kantor'=>$ctkPenulDatatransakss-> kode_kantor,
             'pib'=>$ctkPenulDatatransakss-> pib,
             'tglpib'=>$ctkPenulDatatransakss-> tglpib,
             'npwp_imp'=>$ctkPenulDatatransakss-> npwp_imp,
             'imp'=>$ctkPenulDatatransakss-> imp,
             'seri_brg'=>$ctkPenulDatatransakss-> seri_brg,
             // 'uraian_brg'=>$ctkPenulDatatransakss-> uraian_brg,
             // 'hs'=>$ctkPenulDatatransakss-> hs,
             // 'trf_bm'=>$ctkPenulDatatransakss-> trf_bm,
             // 'bm_nilai_awal'=>$ctkPenulDatatransakss-> bm_nilai_awal,
             // 'hs_t'=>$ctkPenulDatatransakss-> hs_t,
             // 'trf_bm_t'=>$ctkPenulDatatransakss-> trf_bm_t,
             // 'bm_t_nilai_akhir'=>$ctkPenulDatatransakss-> bm_t_nilai_akhir,
             // 'ppn_nilai_awal'=>$ctkPenulDatatransakss-> ppn_nilai_awal,
             // 'ppn_t_nilai_akhir'=>$ctkPenulDatatransakss-> ppn_t_nilai_akhir,
             // 'pph_nilai_awal'=>$ctkPenulDatatransakss-> pph_nilai_awal,
             // 'pph_t_nilai_akhir'=>$ctkPenulDatatransakss-> pph_t_nilai_akhir,
             // 'ppnbm_t_nilai_akhir'=>$ctkPenulDatatransakss-> ppnbm_t_nilai_akhir,
             // 'denda'=>$ctkPenulDatatransakss-> denda,
             // 'total_tagihan'=>$ctkPenulDatatransakss-> total_tagihan,


           ];
         }       
         $OpenTBS->MergeBlock('a1' ,$b1);


         $b2 = [];
         foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss2){
          $b2[] = [
             //'id' => $ctksrtb1 -> id,
           'kode_kantor'=>$ctkPenulDatatransakss2-> kode_kantor,
           'pib'=>$ctkPenulDatatransakss2-> pib,

           'tglpib'=>$ctkPenulDatatransakss2-> tglpib,
           'npwp_imp'=>$ctkPenulDatatransakss2-> npwp_imp,
           'imp'=>$ctkPenulDatatransakss2-> imp,
           'seri_brg'=>$ctkPenulDatatransakss2-> seri_brg,
             // 'bm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> bm_t_nilai_akhir,
             // 'ppn_nilai_awal'=>$ctkPenulDatatransakss2-> ppn_nilai_awal,
             // 'ppn_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppn_t_nilai_akhir,
             // 'pph_nilai_awal'=>$ctkPenulDatatransakss2-> pph_nilai_awal,
             // 'pph_t_nilai_akhir'=>$ctkPenulDatatransakss2-> pph_t_nilai_akhir,
             // 'ppnbm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppnbm_t_nilai_akhir,
             // 'denda'=>$ctkPenulDatatransakss2-> denda,
             // 'total_tagihan'=>$ctkPenulDatatransakss2-> total_tagihan,
         ];
       }       
       $OpenTBS->MergeBlock('a2' ,$b2);


       // $b3=[];
       // $b3[]=[
       //  'xfilettd'=>$path
       // ];
       // $OpenTBS->MergeBlock('a3' ,$b3);

       // var_dump(strip_tags($ctkPenulHeader -> analisa_prosedur_rha));die() ;
       // var_dump($ctkPenulHeader -> nhpu_tgl);die() ;
       //  var_dump($path);die( ) ;

        // var_dump($ctkPfpd->web_filename);die() ;
        //  var_dump($ctkPenulDatatransaks);die() ;
        //  var_dump($OpenTBS->VarRef['xtglnhpu']); die() ;
        // die() ; 

          // $OpenTBS->Show(OPENTBS_DOWNLOAD, 'rha'.'.xlsx'); // Also merges all [onshow] automatic fields.
         $OpenTBS->Show(OPENTBS_DOWNLOAD, 'nhpu'.$id.'.docx'); // Also merges all [onshow] automatic fields.  
         exit;
        //  return $this -> reload();
        //  return $ctksrt->renderAjax();
       }




       public function actionImportdatadirect($id)
       {
      //$query = New Query();
         $query = \app\models\PenulDatatransaks::find()->where(['link_header' => $id]);
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

            // if ((string)$sheetData[$baseRow]['P'] == "HH")(  $model ->jalur = "Hijau")

            while(!empty($sheetData[$baseRow]['A'])){
              $model = new Penuldatatransaks();
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


          // if ((string)$sheetData[$baseRow]['P'] == "HH")(  $model ->jalur = "Hijau");
          // if ((string)$sheetData[$baseRow]['P'] == "HL")(  $model ->jalur = "Hijau");
          // if ((string)$sheetData[$baseRow]['P'] == "HM")(  $model ->jalur = "Hijau");


         // $model->bm_t_nilai_akhir =(
         //  ((float)$sheetData[$baseRow]['L'] - (float)$sheetData[$baseRow]['K']) * (float)$sheetData[$baseRow]['M'] ;
         // if trf_bm = 0 then  $model->nilaipabean_akhir = $model->nilaipabean_awal
         // else
         // hanya salah tarif BM


           //   $model->nilaipabean_akhir = ($model->nilaipabean_awal);
         // selisih BM , PPN dan pph
              $model->bm_t_nilai_akhir = (float)(($model->trf_bm_t/100 *  $model->nilaipabean_akhir)- ($model->trf_bm/100 *  $model->nilaipabean_awal));


              if (($model->ppn_nilai_awal) > 0   ){
            $model->ppn_t_nilai_akhir = (float)(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) *  $model->trf_ppn_t/100 ) - $model->ppn_nilai_awal); // potensi ppn
            ;
          //     return $path ;
          }else{ 
            $model->ppn_t_nilai_akhir = 0 ; // potensi ppn
          };

              // $model->ppn_t_nilai_akhir = (float)(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) *  $model->trf_ppn_t/100 ) - $model->ppn_nilai_awal); // potensi ppn


          if (($model->pph_nilai_awal) > 0  ){
          $model->pph_t_nilai_akhir = (float)(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) *   $model->trf_pph_t/100 )- $model->pph_nilai_awal); // potensi pph
          ;
          //     return $path ;
        }else{ 
            $model->pph_t_nilai_akhir = 0 ; // potensi ppn
          };





              // $model->pph_t_nilai_akhir = (float)(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) *   $model->trf_pph_t/100 )- $model->pph_nilai_awal); // potensi pph

              // $model->ppnbm_t_nilai_akhir = floor(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) *   $model->trf_ppnbm_t )- ($model->ppnbm_nilai_awal));

          $model->total_tagihan = floor($model->bm_t_nilai_akhir +  $model->ppn_t_nilai_akhir + $model->pph_t_nilai_akhir);

          // if ((string)$sheetData[$baseRow]['P'] == "HH")(  $model ->jalur = "Hijau");
          // if ((string)$sheetData[$baseRow]['P'] == "HL")(  $model ->jalur = "Hijau");
          // if ((string)$sheetData[$baseRow]['P'] == "HM")(  $model ->jalur = "Hijau");


         // $model->bm_t_nilai_akhir =(
         //  ((float)$sheetData[$baseRow]['L'] - (float)$sheetData[$baseRow]['K']) * (float)$sheetData[$baseRow]['M'] ;
         // if trf_bm = 0 then  $model->nilaipabean_akhir = $model->nilaipabean_awal
         // else
         // hanya salah tarif BM


         //      $model->nilaipabean_akhir = ($model->nilaipabean_awal);
         // // selisih BM , PPN dan pph
         //      $model->bm_t_nilai_akhir = floor($model->trf_bm_t/100 *  $model->nilaipabean_akhir)- ($model->trf_bm/100 *  $model->nilaipabean_awal) ;
         //      $model->ppn_t_nilai_akhir = floor(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) / 10) - $model->ppn_nilai_awal);
         //      $model->pph_t_nilai_akhir = floor(((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir) / 40 )- $model->pph_nilai_awal);
         //      $model->total_tagihan = floor($model->bm_t_nilai_akhir +  $model->ppn_t_nilai_akhir + $model->pph_t_nilai_akhir);
         // // $model->seri_brg = (string)$sheetData[$baseRow]['O'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['P'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['Q'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['S'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['T'];
          $model->created_at = date('Y-m-d H:i:s');
          $model->created_by = Yii::$app->user->identity->id ;
          $model->updated_at = date('Y-m-d H:i:s');
          $model->updated_by = Yii::$app->user->identity->id ;

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

    return $this->render('importdatadirect',[
      'modelImport' => $modelImport,
      'dataProvider' => $dataProvider,

    ]);

  }



  public function actionCetaknhputtd($id)
  {


    $ctkPenulHeader = \app\models\PenulHeader::findOne($id);
    $ctkPenulDatatransaks = \app\models\PenulDatatransaks::find()->andwhere (['link_header'=>$ctkPenulHeader->id,'flag_pusat' => 'setuju'])->all();
    $ctkPenulDatatransaksImp = \app\models\PenulDatatransaks::find()->andwhere (['link_header'=>$ctkPenulHeader->id,'flag_pusat' => 'setuju'])->one();
    $ctkAnalisPenyaji1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
    $ctkPfpd = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->pfpd])->one();
    $ctkKasi = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kasi])->one();
    $ctkKabid = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kabid])->one();
    $ctkJendok = \app\models\JenDok::find()->where (['id'=>$ctkPenulHeader->jen_dok])->one();


    Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
            // $path = Yii::$app->params['uploadPath'] . $ctkPfpdttd->web_filename;

          // Initalize the TBS instance
          $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
          //$OpenTBS->Plugin(OPENTBS_PLUGIN);
          //$template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_NHPU_ver1.docx';
           $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_NHPU_ver1_sign_ok.docx';// pakai insert  ttdtemplate_NHPU_ver1_sign_ok
          // $template = Yii::getAlias('@web').'/templatepenul/'.'templaterhav1.xlsx';
           $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).

           
           $OpenTBS->VarRef['xid']=$ctkPenulHeader -> id;
           $OpenTBS->VarRef['xnhpu']=$ctkPenulHeader -> nhpu;
           $OpenTBS->VarRef['xtglnhpu']=$ctkPenulHeader -> nhpu_tgl;
           $OpenTBS->VarRef['xnpp']=$ctkPenulHeader -> npp;
           $OpenTBS->VarRef['xst']=$ctkPenulHeader -> st;
           $OpenTBS->VarRef['xtglst']=$ctkPenulHeader -> st_tgl;
           $OpenTBS->VarRef['xrha']=$ctkPenulHeader -> rha;
           $OpenTBS->VarRef['xtglrha']=$ctkPenulHeader -> rha_tgl;
           $OpenTBS->VarRef['xst1']=$ctkPenulHeader -> st;
           $OpenTBS->VarRef['xtglst1']=$ctkPenulHeader -> st_tgl;
           $OpenTBS->VarRef['xlaop']=$ctkPenulHeader -> laop;
           $OpenTBS->VarRef['xtgllaop']=$ctkPenulHeader -> laop_tgl;
           $OpenTBS->VarRef['xkesimpulanlaop']=$ctkPenulHeader -> kesimpulan_laop;
           $OpenTBS->VarRef['xnilaipotensi']=$ctkPenulHeader -> kesimpulan_rha_nilaipotensi;
           $OpenTBS->VarRef['xjumlahpt']=$ctkPenulHeader -> kesimpulan_rha_jum_pt;
           $OpenTBS->VarRef['xpenyaji1']=$ctkAnalisPenyaji1 -> name;
           $OpenTBS->VarRef['xjendok']= $ctkJendok -> name;
           $OpenTBS->VarRef['xjendok1']= $ctkJendok -> name;
           $OpenTBS->VarRef['xpfpd']=$ctkPfpd -> name;
           $OpenTBS->VarRef['xkasi']=$ctkKasi -> name;
           $OpenTBS->VarRef['xkabid']=$ctkKabid -> name;
           $OpenTBS->VarRef['xnippenyaji1']=$ctkAnalisPenyaji1 -> nip;
           $OpenTBS->VarRef['xnippfpd']=$ctkPfpd -> nip;
           $OpenTBS->VarRef['xnipkasi']=$ctkKasi -> nip;
           $OpenTBS->VarRef['xnipkabid']=$ctkKabid -> nip;
           $OpenTBS->VarRef['ximp']=$ctkPenulDatatransaksImp -> imp;
           $OpenTBS->VarRef['ximp1']=$ctkPenulDatatransaksImp -> imp;
           $OpenTBS->VarRef['ximp2']=$ctkPenulDatatransaksImp -> imp;
           $OpenTBS->VarRef['xnpwp']=$ctkPenulDatatransaksImp -> npwp_imp;
           $OpenTBS->VarRef['xnpwp1']=$ctkPenulDatatransaksImp -> npwp_imp;

           
           $path = $ctkPfpd -> web_filename;
           $path1 = $ctkKasi -> web_filename;
           $path2 = $ctkAnalisPenyaji1 -> web_filename;

           if (($path ) !== null ){
            $path = $ctkPfpd -> web_filename;
          //     return $path ;
          }else{ 
           $path= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};


           if (($path1 ) !== null ){
            $path1 = $ctkKasi -> web_filename;
          //     return $path ;

          }else{ 
           $path1= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};

           if (($path2) !== '' ){
            $path2= $ctkAnalisPenyaji1 -> web_filename;
               //return $path ;

          }else{ 
           $path2='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};
           //$path= '8pcDZZcykyQcfHw-ors6LBH67HN87FdC.jpg';}; //penul-v1



           $OpenTBS->VarRef['xfilettd']= Yii::$app->params['uploadPath'].$path;  
           $OpenTBS->VarRef['xfilettd1']= Yii::$app->params['uploadPath'].$path1;  
           $OpenTBS->VarRef['xfilettd2']= Yii::$app->params['uploadPath'].$path2;  


             //$OpenTBS->VarRef['xfilettd']=trim(Yii::$app->params['uploadPath'].$path);  
             //$OpenTBS->VarRef['xfilettd']= Yii::$app->params['uploadPath'].$ctkPfpd->web_filename;          
            // $OpenTBS->VarRef['xfilettd1']= Yii::$app->params['uploadPath'].$ctkKasi->web_filename;
            // $OpenTBS->VarRef['xfilettd2']= Yii::$app->params['uploadPath'].$ctkKabid->web_filename;
            // $OpenTBS->VarRef['xfilettd3']= Yii::$app->params['uploadPath'].$ctkAnalisPenyaji1->web_filename;

           //$test1 -> strip_tags($ctkPenulHeader -> analisa_prosedur_rha)
           //$OpenTBS->VarRef['xanalisa_prosedur_rha']= $test1;

           $vowel = array("&nbsp", ";", "â");
           $OpenTBS->VarRef['xanalisa_prosedur_rha']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha));
           $OpenTBS->VarRef['xanalisa_prosedur_rha2']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha2));
           $OpenTBS->VarRef['xanalisa_prosedur_rha3']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha3));
           $OpenTBS->VarRef['xanalisa_prosedur_rha4']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha4));
           $OpenTBS->VarRef['xanalisa_prosedur_rha5']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha5));
           $OpenTBS->VarRef['xanalisa_prosedur_rha6']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha6));
           $OpenTBS->VarRef['xanalisa_prosedur_rha7']= str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha7));
           ;

           $b1 = [];
           foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss){
            $b1[] = [
             //'id' => $ctksrtb1 -> id,
             'kode_kantor'=>$ctkPenulDatatransakss-> kode_kantor,
             'pib'=>$ctkPenulDatatransakss-> pib,
             'tglpib'=>$ctkPenulDatatransakss-> tglpib,
             'npwp_imp'=>$ctkPenulDatatransakss-> npwp_imp,
             'imp'=>$ctkPenulDatatransakss-> imp,
             'seri_brg'=>$ctkPenulDatatransakss-> seri_brg,
             // 'uraian_brg'=>$ctkPenulDatatransakss-> uraian_brg,
             // 'hs'=>$ctkPenulDatatransakss-> hs,
             // 'total_tagihan'=>$ctkPenulDatatransakss-> total_tagihan,


           ];
         }       
         $OpenTBS->MergeBlock('a1' ,$b1);


         $b2 = [];
         foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss2){
          $b2[] = [
             //'id' => $ctksrtb1 -> id,
           'kode_kantor'=>$ctkPenulDatatransakss2-> kode_kantor,
           'pib'=>$ctkPenulDatatransakss2-> pib,

           'tglpib'=>$ctkPenulDatatransakss2-> tglpib,
           'npwp_imp'=>$ctkPenulDatatransakss2-> npwp_imp,
           'imp'=>$ctkPenulDatatransakss2-> imp,
           'seri_brg'=>$ctkPenulDatatransakss2-> seri_brg,
             // 'bm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> bm_t_nilai_akhir,

         ];
       }       
       $OpenTBS->MergeBlock('a2' ,$b2);


       // $b3=[];
       // $b3[]=[
       //  'xfilettd'=>$path
       // ];
       // $OpenTBS->MergeBlock('a3' ,$b3);

      // var_dump(strip_tags($ctkPenulHeader -> analisa_prosedur_rha));die() ;
       // var_dump($issuingcountrys->name);die() ;
       //  var_dump($path);
       // var_dump($path1);
       //   var_dump($path2);die( ) ;

        // var_dump($ctkPfpd->web_filename);die() ;
       //  var_dump($ctkPenulDatatransaks);die() ;
       //    var_dump($OpenTBS->VarRef['xfilettd']); die() ;
          // die() ; 

          // $OpenTBS->Show(OPENTBS_DOWNLOAD, 'rha'.'.xlsx'); // Also merges all [onshow] automatic fields.
         $OpenTBS->Show(OPENTBS_DOWNLOAD, 'nhpu_signed'.$id.'.docx'); // Also merges all [onshow] automatic fields.  
         exit;
        //  return $this -> reload();
        //  return $ctksrt->renderAjax();
       }



       public function actionCetakkkpttd($id)
       {

        $ctkPenulHeader = \app\models\PenulHeader::findOne($id);
        $ctkPenulDatatransaks = \app\models\PenulDatatransaks::find()->andwhere (['link_header'=>$ctkPenulHeader->id,'flag_pusat' => 'setuju'])->all();
        //$ctkAnalisPenyaji1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
        $ctkPfpd = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->pfpd])->one();
        $ctkKasi = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kasi])->one();
        $ctkKabid = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->kabid])->one();
        $ctkPenyajidata1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
        $ctkJendok = \app\models\JenDok::find()->where (['id'=>$ctkPenulHeader->jen_dok])->one();

        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';

          // Initalize the TBS instance
          $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
         // $TBS->PlugIn(OPENTBS_MERGE_SPECIAL_ITEMS);
         // $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_KertasKerja_v2_sign.xlsx';
          $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/kkp_template_KKP_ver1_sign_1.docx';
          // $template = Yii::getAlias('@web').'/templatepenul/'.'templaterhav1.xlsx';
           $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
           
           $OpenTBS->VarRef['xid']=$ctkPenulHeader -> id;
           $OpenTBS->VarRef['xkkp']=$ctkPenulHeader -> kkp;
           $OpenTBS->VarRef['xtglkkp']=$ctkPenulHeader -> kkp_tgl ;
           $OpenTBS->VarRef['xjendok']= $ctkJendok -> name;
           $OpenTBS->VarRef['xpfpd']=$ctkPfpd -> name;
           $OpenTBS->VarRef['xkasi']=$ctkKasi -> name;
           $OpenTBS->VarRef['xkabid']=$ctkKabid -> name;
           $OpenTBS->VarRef['xpenyajidata1']=$ctkPenyajidata1 -> name;
         // $OpenTBS->VarRef['xno_srtpemberitahuan']= $ctksrt -> no_srtpemberitahuan;

           $path = $ctkPfpd -> web_filename;
           $path1 = $ctkKasi -> web_filename;
           $path02 = $ctkPenyajidata1 -> web_filename;

          //  if (($path ) !== null ){
          //   $path = $ctkPfpd -> web_filename;
          // //     return $path ;
          // }else{ 
          //  $path= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};

          //  if (($path1 ) !== null ){
          //   $path1 = $ctkKasi -> web_filename;
          // //     return $path ;
          // }
          // else{ 
          //  $path1= 'QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};



           if (($path) === null ){
            $path='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
               //return $path ;
          }
          elseif (($path) === '' ){
            $path1='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
             //return $path ;
          }
          else{ 
            $path= $ctkPfpd -> web_filename;}; 


          // if (($path1) === null ){
          //       $path1='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
          //      //return $path ;
          // }
          // elseif (($path1) === '' ){
          //   $path1='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
          //      //return $path ;
          // }
          // else{ 
          //   $path1= $ctkKasi -> web_filename;};


            if (($path02) === null ){
           // $path2= $ctkPenyajidata1 -> web_filename;
              $path2='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
               //return $path ;
            }
            elseif (($path02) === '' ){
            //$path2= $ctkPenyajidata1 -> web_filename;
              $path2='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
               //return $path ;
            }
            else{ 
              $path2= $ctkPenyajidata1 -> web_filename;};
           //$path2='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';};
           // if ($row['telp'] === NULL) { $no_telp = 'NULL'; }
           //  elseif ($row['telp'] === '') { $no_telp ='belum ada'; } 
           //  else { $no_telp = $row['telp']; };

              $OpenTBS->VarRef['xfilettd']= Yii::$app->params['uploadPath'].$path;  
           //$OpenTBS->VarRef['xfilettd1']= Yii::$app->params['uploadPath'].$path1;  
              $OpenTBS->VarRef['xfilettd2']= Yii::$app->params['uploadPath'].$path2;
          // $xfilettd2_picture = Yii::$app->params['uploadPath'].$path2;
          // $TBS->PlugIn(OPENTBS_MERGE_SPECIAL_ITEMS);  


              $b1 = [];
              foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss){
                $b1[] = [
             //'id' => $ctksrtb1 -> id,
                 'kode_kantor'=>$ctkPenulDatatransakss-> kode_kantor,
                 'pib'=>$ctkPenulDatatransakss-> pib,
                 'tglpib'=>$ctkPenulDatatransakss-> tglpib,
                 'npwp_imp'=>$ctkPenulDatatransakss-> npwp_imp,
                 'imp'=>$ctkPenulDatatransakss-> imp,
                 'seri_brg'=>$ctkPenulDatatransakss-> seri_brg,
                 'uraian_brg'=>$ctkPenulDatatransakss-> uraian_brg,
                 'hs'=>$ctkPenulDatatransakss-> hs,
                 'trf_bm'=>$ctkPenulDatatransakss-> trf_bm,
                 'bm_nilai_awal'=>$ctkPenulDatatransakss-> bm_nilai_awal,
                 'nilaipabean_awal'=>$ctkPenulDatatransakss-> nilaipabean_awal,
                 'hs_t'=>$ctkPenulDatatransakss-> hs_t,
                 'trf_bm_t'=>$ctkPenulDatatransakss-> trf_bm_t,
                 'bm_t_nilai_akhir'=>$ctkPenulDatatransakss-> bm_t_nilai_akhir,
                 'nilaipabean_akhir'=>$ctkPenulDatatransakss-> nilaipabean_akhir,

               ];
             }       
             $OpenTBS->MergeBlock('a1' ,$b1);


             $b2 = [];
             foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss2){
              $b2[] = [
             //'id' => $ctksrtb1 -> id,
               'kode_kantor'=>$ctkPenulDatatransakss2-> kode_kantor,
               'pib'=>$ctkPenulDatatransakss2-> pib,
               'tglpib'=>$ctkPenulDatatransakss2-> tglpib,
               'npwp_imp'=>$ctkPenulDatatransakss2-> npwp_imp,
               'imp'=>$ctkPenulDatatransakss2-> imp,
               'bm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> bm_t_nilai_akhir,
               'ppn_nilai_awal'=>$ctkPenulDatatransakss2-> ppn_nilai_awal,
               'ppn_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppn_t_nilai_akhir,
               'pph_nilai_awal'=>$ctkPenulDatatransakss2-> pph_nilai_awal,
               'pph_t_nilai_akhir'=>$ctkPenulDatatransakss2-> pph_t_nilai_akhir,
               'ppnbm_t_nilai_akhir'=>$ctkPenulDatatransakss2-> ppnbm_t_nilai_akhir,
               'denda'=>$ctkPenulDatatransakss2-> denda,
               'total_tagihan'=>$ctkPenulDatatransakss2-> total_tagihan,
             ];
           }       
           $OpenTBS->MergeBlock('a2' ,$b2);

        //var_dump($path);
        //var_dump($path1);
        //var_dump($path02);
        //var_dump($path2);//die( ) ;
          //var_dump($ctksrt ->jenis_reference);
          //var_dump($ctkPenulDatatransaks);
          //var_dump($OpenTBS->VarRef['xfilettd2']);
          //die( ) ;



         //$OpenTBS->Show(OPENTBS_DOWNLOAD, 'kkp_signed'.$id.'.xlsx'); // Also merges all [onshow] automatic fields.  
         $OpenTBS->Show(OPENTBS_DOWNLOAD, 'kkp_signed'.$id.'.docx'); // Also merges all [onshow] automatic fields. 
         exit;
        //  //return $this -> reload();
        //  return $ctksrt->renderAjax();
       }

       public function actionImportdatadirect02($id)
       {
      //$query = New Query();
         $query = \app\models\PenulDatatransaks::find()->where(['link_header' => $id]);
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

            // if ((string)$sheetData[$baseRow]['P'] == "HH")(  $model ->jalur = "Hijau")

            while(!empty($sheetData[$baseRow]['A'])){
              $model = new Penuldatatransaks();
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

         // if ((string)$sheetData[$baseRow]['P'] == "HH")(  $model ->jalur = "Hijau");
         // if ((string)$sheetData[$baseRow]['P'] == "HL")(  $model ->jalur = "Hijau");
         // if ((string)$sheetData[$baseRow]['P'] == "HM")(  $model ->jalur = "Hijau");
         // $model->bm_t_nilai_akhir =(
         // ((float)$sheetData[$baseRow]['L'] - (float)$sheetData[$baseRow]['K']) * (float)$sheetData[$baseRow]['M'] ;
         // if trf_bm = 0 then  $model->nilaipabean_akhir = $model->nilaipabean_awal
         // else
         // hanya salah tarif BM


           //   $model->nilaipabean_akhir = ($model->nilaipabean_awal);
         // selisih BM , PPN dan pph
              $model->bm_t_nilai_akhir = float($model->trf_bm_t/100 *$model->nilaipabean_akhir)-($model->trf_bm/100 * $model->nilaipabean_awal) ;

              $model->ppn_t_nilai_akhir = float((((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+$model->nilaipabean_akhir)) *  $model->trf_ppn_t/100 ) - $model->ppn_nilai_awal);

              $model->pph_t_nilai_akhir = float((((($model->trf_bm_t/100 *  $model->nilaipabean_akhir )+  $model->nilaipabean_akhir)) *   $model->trf_pph_t/100 ) - $model->pph_nilai_awal);

              // $model->ppn_t_nilai_akhir = float((($model->bm_t_nilai_akhir +  $model->nilaipabean_akhir) *  $model->trf_ppn_t ) - $model->ppn_nilai_awal);

              // $model->pph_t_nilai_akhir = float((($model->bm_t_nilai_akhir +  $model->nilaipabean_akhir) *   $model->trf_pph_t ) - $model->pph_nilai_awal);



              $model->total_tagihan = float($model->bm_t_nilai_akhir +  $model->ppn_t_nilai_akhir + $model->pph_t_nilai_akhir);


         // $model->seri_brg = (string)$sheetData[$baseRow]['O'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['P'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['Q'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['S'];
         // $model->seri_brg = (string)$sheetData[$baseRow]['T'];
              $model->created_at = date('Y-m-d H:i:s');
              $model->created_by = Yii::$app->user->identity->id ;
              $model->updated_at = date('Y-m-d H:i:s');
              $model->updated_by = Yii::$app->user->identity->id ;

              $model->save();
              $baseRow++;
            }
            Yii::$app->getSession()->setFlash('success', 'Success');
      // echo $baseRow;
      // var_dump($model->trf_bm_t);
      //  var_dump($model->total_tagihan);
      //  die( ) ;
          }
          else{
            Yii::$app->getSession()->setFlash('error', 'Error');
          }
        }

        return $this->render('importdatadirect02',[
          'modelImport' => $modelImport,
          'dataProvider' => $dataProvider,

        ]);

      }

      public function actionExcelRha($id){

        $ctkPenulHeader = \app\models\PenulHeader::findOne($id);
        $ctkPenulDatatransaks = \app\models\PenulDatatransaks::find()->where (['link_header'=>$ctkPenulHeader->id])->all();
        $ctkAnalisPenyaji1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
        $ctkAnalis1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis1])->one();
        $ctkAnalis2 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis2])->one();
        $ctkAnalis3 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis3])->one();
        $ctkAnalis2ttd = \app\models\PenulAnalisPenyaji::find('web_filename')->where (['id'=>$ctkPenulHeader->analis2])->one();
        $ctkJendok = \app\models\JenDok::find()->where (['id'=>$ctkPenulHeader->jen_dok])->one();
        $ctkJenPelanggaran = \app\models\JenPelanggaran::find()->where (['id'=>$ctkPenulHeader->jen_pelanggaran])->one();

       // $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/template_RHA_sp.xlsx';

      //  $spreadsheet = IOFactory::load($template);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4); 


        // Set document properties
        $spreadsheet->getProperties()->setCreator('Dens_2021')
        ->setLastModifiedBy('Maarten Balliauw')
        ->setTitle('Office 2007 XLSX Test Document')
        ->setSubject('Office 2007 XLSX Test Document')
        ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Test result file');



        // Add some data
       $baseRow=12; // line 2
       //$baseRows=28 +  $baseRow ;

       foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss){
        $spreadsheet->getActiveSheet()->setCellValue('A'.$baseRow, $baseRow-11);
        // $spreadsheet->getActiveSheet()->setCellValue('A'.$baseRows, $baseRows-39);

        $spreadsheet->getActiveSheet()->setCellValue('B'.$baseRow, $ctkPenulDatatransakss->kode_kantor);
        //  $spreadsheet->getActiveSheet()->setCellValue('B'.$baseRows,$ctkPenulDatatransakss->kode_kantor );

        $spreadsheet->getActiveSheet()->setCellValue('C'.$baseRow, $ctkPenulDatatransakss->pib);
       //  $spreadsheet->getActiveSheet()->setCellValue('C'.$baseRows, $ctkPenulDatatransakss->pib);

        $spreadsheet->getActiveSheet()->setCellValue('D'.$baseRow, $ctkPenulDatatransakss->tglpib);
       //  $spreadsheet->getActiveSheet()->setCellValue('D'.$baseRows, $ctkPenulDatatransakss->tglpib);

        $spreadsheet->getActiveSheet()->setCellValue('E'.$baseRow, $ctkPenulDatatransakss->npwp_imp);
       // $spreadsheet->getActiveSheet()->setCellValue('E'.$baseRows, $ctkPenulDatatransakss->npwp_imp);

        $spreadsheet->getActiveSheet()->setCellValue('F'.$baseRow, $ctkPenulDatatransakss->imp);
        //  $spreadsheet->getActiveSheet()->setCellValue('F'.$baseRows, $ctkPenulDatatransakss->imp);

        $spreadsheet->getActiveSheet()->setCellValue('G'.$baseRow, $ctkPenulDatatransakss->seri_brg);
        // $spreadsheet->getActiveSheet()->setCellValue('G'.$baseRows, $ctkPenulDatatransakss->bm_t_nilai_akhir);

        $spreadsheet->getActiveSheet()->setCellValue('H'.$baseRow, $ctkPenulDatatransakss->uraian_brg);
        $spreadsheet->getActiveSheet()->setCellValue('I'.$baseRow, $ctkPenulDatatransakss->hs);

        $spreadsheet->getActiveSheet()->setCellValue('J'.$baseRow, $ctkPenulDatatransakss->trf_bm);
      //  $spreadsheet->getActiveSheet()->setCellValue('J'.$baseRows, $ctkPenulDatatransakss->ppn_t_nilai_akhir);

        $spreadsheet->getActiveSheet()->setCellValue('K'.$baseRow, $ctkPenulDatatransakss->nilaipabean_awal);

      //  $spreadsheet->getActiveSheet()->setCellValue('K'.$baseRows, $ctkPenulDatatransakss->pph_t_nilai_akhir);


        $spreadsheet->getActiveSheet()->setCellValue('L'.$baseRow, $ctkPenulDatatransakss->hs_t);
       //    $spreadsheet->getActiveSheet()->setCellValue('L'.$baseRows, $ctkPenulDatatransakss->ppnbm_t_nilai_akhir);


        $spreadsheet->getActiveSheet()->setCellValue('M'.$baseRow, $ctkPenulDatatransakss->trf_bm_t);
       // $spreadsheet->getActiveSheet()->setCellValue('M'.$baseRows, $ctkPenulDatatransakss->denda);

        $spreadsheet->getActiveSheet()->setCellValue('N'.$baseRow, $ctkPenulDatatransakss->nilaipabean_akhir);

        $spreadsheet->getActiveSheet()->setCellValue('O'.$baseRow, '=O8');

        $baseRow++;
      }



      $vowel = array("&nbsp", ";", "â");
      $xanalisa_prosedur_rha = str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha));
      $xanalisa_prosedur_rha2= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha2));
      $xanalisa_prosedur_rha3 = str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha3));
      $xanalisa_prosedur_rha4= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha4));
      $xanalisa_prosedur_rha5 = str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha5));
      $xanalisa_prosedur_rha6= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha6));
      $xanalisa_prosedur_rha7= str_replace( $vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha7));

      $spreadsheet->setActiveSheetIndex(0);
      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 1),'E.')
      ->setCellValue('B'.(string)($baseRow + 1),'ANALISIS/PROSEDUR');
      $spreadsheet->getActiveSheet()->mergeCells('B'.(string)($baseRow + 1).':D'.(string)($baseRow + 1));

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 2),'1')
      ->setCellValue('B'.(string)($baseRow + 2),'Undang-Undang Nomor 17 Tahun 2006 Tentang Perubahan atas Undang-Undang Nomor 10 Tahun 1995 Tentang Kepabeanan pada Pasal 17 ayat (1) menyebutkan bahwa Direktur Jenderal dapat menetapkan kembali tarif dan nilai pabean untuk penghitungan bea masuk dalam jangka waktu 2 (dua) tahun terhitung sejak tanggal pemberitahuan pabean.');
      $spreadsheet->getActiveSheet()->mergeCells('B'.(string)($baseRow + 2).':N'.(string)($baseRow + 2));
      $spreadsheet->getActiveSheet()->getStyle('B'.(string)($baseRow + 2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 2))->setRowHeight(60);

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 3),'2')
      ->setCellValue('B'.(string)($baseRow + 3),'Dokumen BC 2.0 terbit setelah berlakunya PMK 06/PMK.010/2017 yaitu tanggal 26 Januari 2017, menggunakan HS Klasifikasi 8 digit.');
      $spreadsheet->getActiveSheet()->mergeCells('B'.(string)($baseRow + 3).':N'.(string)($baseRow + 3));
      $spreadsheet->getActiveSheet()->getStyle('B'.(string)($baseRow + 3))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 4),'3')
      ->setCellValue('B'.(string)($baseRow + 4),  ($xanalisa_prosedur_rha));
      $spreadsheet->getActiveSheet()->mergeCells('B'.(string)($baseRow + 4).':N'.(string)($baseRow + 4));
      $spreadsheet->getActiveSheet()->getStyle('B'.(string)($baseRow + 4))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 4))->setRowHeight(60);

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 5),'4')
      ->setCellValue('B'.(string)($baseRow + 5),'Latar Belakang Penetapan');
      $spreadsheet->getActiveSheet()->mergeCells('B'.(string)($baseRow + 5).':D'.(string)($baseRow + 5));


      $spreadsheet->getActiveSheet()->setCellValue('B'.(string)($baseRow + 6),  ($xanalisa_prosedur_rha2))
      ->mergeCells('B'.(string)($baseRow + 6).':N'.(string)($baseRow + 6))
      ->getStyle('B'.(string)($baseRow + 6))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 6))->setRowHeight(60);



      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 7),'5')
      ->setCellValue('B'.(string)($baseRow + 7),'Identifikasi Permasalahan')
      ->mergeCells('B'.(string)($baseRow + 7).':D'.(string)($baseRow + 7))
      ->getStyle('B'.(string)($baseRow + 7))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);


      $spreadsheet->getActiveSheet()->setCellValue('B'.(string)($baseRow + 8),  ($xanalisa_prosedur_rha3))
      ->mergeCells('B'.(string)($baseRow + 8).':N'.(string)($baseRow + 8))
      ->getStyle('B'.(string)($baseRow + 8))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 8))->setRowHeight(60);

      $spreadsheet->getActiveSheet()->setCellValue('B'.(string)($baseRow + 9),  ($xanalisa_prosedur_rha4))
      ->mergeCells('B'.(string)($baseRow + 9).':N'.(string)($baseRow + 9))
      ->getStyle('B'.(string)($baseRow + 9))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 9))->setRowHeight(60);


      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 10),'6')
      ->setCellValue('B'.(string)($baseRow + 10),'Identifikasi Barang')
      ->mergeCells('B'.(string)($baseRow + 10).':D'.(string)($baseRow + 10))
      ->getStyle('B'.(string)($baseRow + 10))->getAlignment()->setHorizontal(Alignment::VERTICAL_TOP);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 10))->setRowHeight(110);

      // if (($path_dg) === null ){
      //      // $path2= $ctkPenyajidata1 -> web_filename;
      //         $path_dg='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
      //          //return $path ;
      //       }
      //       elseif (($path_dg) === '' ){
      //       //$path2= $ctkPenyajidata1 -> web_filename;
      //         $path_dg='QUH6Mq6AjRY2IUp5dRZz0Ht2sYpd2bsV.jpg';
      //          //return $path ;
      //       }
      //       else{ 
      //         $path_dg= $ctkPenulHeader -> datagambar_filename;};     

      $path_dg = $ctkPenulHeader -> datagambar_filename;
      

      $drawing = new Drawing();
      $drawing->setName('PhpSpreadsheet logo');
      $drawing->setDescription('PhpSpreadsheet logo');
     // $drawing->setPath(__DIR__ . '/../images/PhpSpreadsheet_logo.png');
      $drawing->setPath(__DIR__ . '/../web/uploads/'.$path_dg);
      $drawing->setHeight(70);
      $drawing->setCoordinates('E'.(string)($baseRow + 10));
      $drawing->setOffsetX(20);
      $drawing->setWorksheet($spreadsheet->getActiveSheet());


      $spreadsheet->getActiveSheet()->setCellValue('B'.(string)($baseRow + 11),  ($xanalisa_prosedur_rha5))
      ->mergeCells('B'.(string)($baseRow + 11).':N'.(string)($baseRow + 11))
      ->getStyle('B'.(string)($baseRow + 11))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 11))->setRowHeight(120);


      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 12),'7')
      ->setCellValue('B'.(string)($baseRow + 12),'Penetapan HS Code')
      ->mergeCells('B'.(string)($baseRow + 12).':D'.(string)($baseRow + 12))
      ->getStyle('B'.(string)($baseRow + 12))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);


      $spreadsheet->getActiveSheet()->setCellValue('B'.(string)($baseRow + 13),($xanalisa_prosedur_rha6))
      ->mergeCells('B'.(string)($baseRow + 13).':N'.(string)($baseRow + 13))
      ->getStyle('B'.(string)($baseRow + 13))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 13))->setRowHeight(90);

      $spreadsheet->getActiveSheet()->setCellValue('B'.(string)($baseRow + 14),  ($xanalisa_prosedur_rha7))
      ->mergeCells('B'.(string)($baseRow + 14).':N'.(string)($baseRow + 14))
      ->getStyle('B'.(string)($baseRow + 14))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 14))->setRowHeight(50);



      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 16),'F.')
      ->setCellValue('B'.(string)($baseRow + 16),'POTENSI TAGIHAN')
      ->mergeCells('B'.(string)($baseRow + 16).':D'.(string)($baseRow + 16));




      

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 18),'NO.')
      ->setCellValue('B'.(string)($baseRow + 18),'KODE KANTOR')
      ->setCellValue('C'.(string)($baseRow + 18),'NOMOR')
      ->setCellValue('D'.(string)($baseRow + 18),'TANGGAL')
      ->setCellValue('E'.(string)($baseRow + 18),'NPWP')
      ->setCellValue('F'.(string)($baseRow + 18),'PERUSAHAAN')
      ->setCellValue('G'.(string)($baseRow + 18),'BEA MASUK')
      ->setCellValue('H'.(string)($baseRow + 18),'BMAD/BMI/BMP')
      ->setCellValue('I'.(string)($baseRow + 18),'BEA KELUAR')
      ->setCellValue('J'.(string)($baseRow + 18),'PPN')
      ->setCellValue('K'.(string)($baseRow + 18),'PPh')
      ->setCellValue('L'.(string)($baseRow + 18),'PPnBM')
      ->setCellValue('M'.(string)($baseRow + 18),'DENDA')
      ->setCellValue('N'.(string)($baseRow + 18),'TOTAL');
      

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 19),'1.')
      ->setCellValue('B'.(string)($baseRow + 19),'2')
      ->setCellValue('C'.(string)($baseRow + 19),'3')
      ->setCellValue('D'.(string)($baseRow + 19),'4')
      ->setCellValue('E'.(string)($baseRow + 19),'5')
      ->setCellValue('F'.(string)($baseRow + 19),'6')
      ->setCellValue('G'.(string)($baseRow + 19),'7')
      ->setCellValue('H'.(string)($baseRow + 19),'8')
      ->setCellValue('I'.(string)($baseRow + 19),'9')
      ->setCellValue('J'.(string)($baseRow + 19),'10')
      ->setCellValue('K'.(string)($baseRow + 19),'11')
      ->setCellValue('L'.(string)($baseRow + 19),'12')
      ->setCellValue('M'.(string)($baseRow + 19),'13')
      ->setCellValue('N'.(string)($baseRow + 19),'14');


      $baseRows= $baseRow +  20;
      foreach($ctkPenulDatatransaks as $ctkPenulDatatransaksss){

        $spreadsheet->getActiveSheet()->setCellValue('A'.$baseRows, $baseRows)
        ->setCellValue('B'.$baseRows,$ctkPenulDatatransaksss->kode_kantor )
        ->setCellValue('C'.$baseRows, $ctkPenulDatatransaksss->pib)
        ->setCellValue('D'.$baseRows, $ctkPenulDatatransaksss->tglpib)
        ->setCellValue('E'.$baseRows, $ctkPenulDatatransaksss->npwp_imp)
        ->setCellValue('F'.$baseRows, $ctkPenulDatatransaksss->imp)
        ->setCellValue('G'.$baseRows, $ctkPenulDatatransaksss->bm_t_nilai_akhir)
        ->setCellValue('J'.$baseRows, $ctkPenulDatatransaksss->ppn_t_nilai_akhir)
        ->setCellValue('K'.$baseRows, $ctkPenulDatatransaksss->pph_t_nilai_akhir)
        ->setCellValue('L'.$baseRows, $ctkPenulDatatransaksss->ppnbm_t_nilai_akhir)
        ->setCellValue('M'.$baseRows, $ctkPenulDatatransaksss->denda)
        ->setCellValue('N'.$baseRows, $ctkPenulDatatransaksss->total_tagihan);
      //  ->getStyle('B'.$baseRows)->getFont()->setSize(11);
        $baseRows++;
      }

$spreadsheet->getActiveSheet()->getStyle('G61')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Miscellaneous glyphs, UTF-8
      $spreadsheet->getActiveSheet()
      ->setCellValue('A10','NO.')
      ->setCellValue('B10','KODE KANTOR')
->setCellValue('C10','NOMOR')
->setCellValue('D10','TANGGAL')
->setCellValue('E10','NPWP')
->setCellValue('F10','PERUSAHAAN')
->setCellValue('G10','NO SERI BARANG')
->setCellValue('H10','URAIAN BARANG')
->setCellValue('I10','HS')
->setCellValue('J10','TARIF')
->setCellValue('K10','NILAI')
->setCellValue('L10','HS')
->setCellValue('M10','TARIF')
->setCellValue('N10','NILAI')
->setCellValue('O10','KET');

$spreadsheet->getActiveSheet()->setCellValue('A11','1.')
->setCellValue('B11','2')
->setCellValue('C11','3')
->setCellValue('D11','4')
->setCellValue('E11','5')
->setCellValue('F11','6')
->setCellValue('G11','7')
->setCellValue('H11','8')
->setCellValue('I11','9')
->setCellValue('J11','10')
->setCellValue('K11','11')
->setCellValue('L11','12')
->setCellValue('M11','13')
->setCellValue('N11','14')
->setCellValue('O11','15');



$spreadsheet->getActiveSheet()
->setCellValue('H1', 'RISALAH HASIL ANALISIS (RHA) NOMOR')
->setCellValue('I1', $ctkPenulHeader ->rha);

$spreadsheet->getActiveSheet()
->setCellValue('A3', 'A')
->setCellValue('B3', 'JENIS DOKUMEN')
->setCellValue('E3', $ctkJendok ->name)
->setCellValue('O3', 'ref_id-'.$ctkPenulHeader ->id);;

$spreadsheet->getActiveSheet()
->setCellValue('A4', 'B')
->setCellValue('B4', 'JENIS PELANGGARAN')
->setCellValue('E4', $ctkJenPelanggaran ->name);

$spreadsheet->getActiveSheet()
->setCellValue('A5', 'C')
->setCellValue('B5', 'DOKUMEN/BUKTI PENDUKUNG')
->setCellValue('E5', 'Dokumen pemberitahuan barang dan dokumen pendukung lainnya');

$spreadsheet->getActiveSheet()
->setCellValue('A7', 'D')
->setCellValue('B7', 'DATA TRANSAKSI');

$spreadsheet->getActiveSheet()->setCellValue('O6', $ctkJenPelanggaran->id)
->getStyle('O6')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

$spreadsheet->getActiveSheet()->setCellValue('O8', '=IF(O6 = 1,"salah tarif","salah nilai")')
->getStyle('O8')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);


$spreadsheet->getActiveSheet()
->setCellValue('G9', '=E3')
->setCellValue('F9', 'JENIS DOKUMEN')
->setCellValue('I9', 'DIBERITAHUKAN')
->setCellValue('L9', 'SEHARUSNYA');
$spreadsheet->getActiveSheet()->setCellValue('F'.(string)($baseRows + 1), 'TOTAL');

//$SUMRANGE = 'D2:D'.$i;
$baseRowG = $baseRow + 20;
$baseRows_t = $baseRows -1;

//$SUMRANGE = 'G'.$baseRowG.':G'.$baseRows - 1;

$SUMRANGE_bm = 'G'.$baseRowG.':G'.$baseRows_t;
$SUMRANGE_ppn = 'J'.$baseRowG.':J'.$baseRows_t;
$SUMRANGE_pph = 'K'.$baseRowG.':K'.$baseRows_t;
$SUMRANGE_total = 'G'.(string)($baseRows + 1).':M'.(string)($baseRows + 1);
$SUMROUNDUP_total = 'G'.(string)($baseRows + 2).':M'.(string)($baseRows + 2);
  // var_dump($SUMRANGE); 
  // die();
$spreadsheet->getActiveSheet()->setCellValue('G'.($baseRows + 1), '=SUM('.$SUMRANGE_bm.')')

->setCellValue('J'.($baseRows + 1), '=SUM('.$SUMRANGE_ppn.')')
->setCellValue('K'.($baseRows + 1), '=SUM('.$SUMRANGE_pph.')')
->setCellValue('N'.($baseRows + 1), '=SUM('.$SUMRANGE_total.')');


$spreadsheet->getActiveSheet()
->setCellValue('F'.(string)($baseRows + 2), 'PEMBULATAN')
->setCellValue('G'.(string)($baseRows + 2), '=ROUNDUP(G'.(string)($baseRows + 1).',-3)')
->setCellValue('J'.(string)($baseRows + 2), '=ROUNDUP(J'.(string)($baseRows + 1).',-3)')
->setCellValue('K'.(string)($baseRows + 2), '=ROUNDUP(K'.(string)($baseRows + 1).',-3)')
->setCellValue('N'.(string)($baseRows + 2), '=SUM('.$SUMROUNDUP_total.')');

$spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRows + 4), 'G')
->setCellValue('B'.(string)($baseRows + 4), 'KESIMPULAN');

$spreadsheet->getActiveSheet()->setCellValue('B'.(string)($baseRows + 6), 'Berdasarkan hasil analisis tersebut ditemukan potensi tambah bayar pada barang - barang tersebut  dengan berbagai tipe sebesar ')
->setCellValue('I'.(string)($baseRows + 6), $ctkPenulHeader->kesimpulan_rha_nilaipotensi);

$spreadsheet->getActiveSheet()->setCellValue('C'.(string)($baseRows + 8), 'Penyaji Data')
->setCellValue('G'.(string)($baseRows + 8), 'Analis 1')
->setCellValue('J'.(string)($baseRows + 8), 'Analis 2')
->setCellValue('M'.(string)($baseRows + 8), 'Analis 3');

$spreadsheet->getActiveSheet()->setCellValue('C'.(string)($baseRows + 12),  $ctkAnalisPenyaji1->name)
->setCellValue('G'.(string)($baseRows + 12), $ctkAnalis1->name)
->setCellValue('J'.(string)($baseRows + 12), $ctkAnalis2->name)
->setCellValue('M'.(string)($baseRows + 12), $ctkAnalis3->name);

        // Rename worksheet


$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);



$spreadsheet->getActiveSheet()->getStyle('A1:N'.(string)($baseRows + 13))->getFont()->setSize(12)
->setName('Arial');
$spreadsheet->getActiveSheet()->getStyle('A10:O11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('A'.(string)($baseRow + 18).':N'.(string)($baseRow + 19))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);



$styleThinBlackBorderOutline = [
  'borders' => [
    'allBorders' => [
      'borderStyle' => Border::BORDER_THIN,
      'color' => ['argb' => 'FF000000'],
    ],


  ],
];

$spreadsheet->getActiveSheet()->getStyle('A10:O'.(string)($baseRow))->applyFromArray($styleThinBlackBorderOutline);
$spreadsheet->getActiveSheet()->getStyle('A'.(string)($baseRow+18).':N'.(string)($baseRows))->applyFromArray($styleThinBlackBorderOutline);

$spreadsheet->getActiveSheet()->setTitle('RHA');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);


$nf0 = "rha_newREF_ID-".$ctkPenulHeader->id.".xlsx";

//same ending
$response = Yii::$app->getResponse();
$headers = $response->getHeaders();

            // Redirect output to a client’s web browser (Xlsx)
$headers->set('Content-Type', 'application/vnd.ms-excel');
$headers->set('Content-Disposition','attachment;filename='.$nf0);

$headers->set('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
$headers->set('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
         $headers->set('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
         $headers->set('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
         $headers->set('Cache-Control: cache, must-revalidate'); // HTTP/1.1
         $headers->set('Pragma: public'); // HTTP/1.0
         ob_start();        
         $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
         $writer->save("php://output");
         $content = ob_get_contents();
         ob_clean();
         return $content;

      //  exit;





       }

             public function actionExcelKkp($id){

        $ctkPenulHeader = \app\models\PenulHeader::findOne($id);
        
         $ctkPenulDatatransaks = \app\models\PenulDatatransaks::find()->andwhere (['link_header'=>$ctkPenulHeader->id,'flag_pusat' => 'setuju'])->all();
         $ctkAnalisPenyaji1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->penyaji_data1])->one();
        $ctkAnalis1 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis1])->one();
        $ctkAnalis2 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis2])->one();
        $ctkAnalis3 = \app\models\PenulAnalisPenyaji::find()->where (['id'=>$ctkPenulHeader->analis3])->one();
        $ctkAnalis2ttd = \app\models\PenulAnalisPenyaji::find('web_filename')->where (['id'=>$ctkPenulHeader->analis2])->one();
        $ctkJendok = \app\models\JenDok::find()->where (['id'=>$ctkPenulHeader->jen_dok])->one();
        $ctkJenPelanggaran = \app\models\JenPelanggaran::find()->where (['id'=>$ctkPenulHeader->jen_pelanggaran])->one();


        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4); 


        // Set document properties
        $spreadsheet->getProperties()->setCreator('Dens_2021')
        ->setLastModifiedBy('Maarten Balliauw')
        ->setTitle('Office 2007 XLSX Test Document')
        ->setSubject('Office 2007 XLSX Test Document')
        ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Test result file');



        // Add some data
       $baseRow=12; // line 2
       //$baseRows=28 +  $baseRow ;

       foreach($ctkPenulDatatransaks as $ctkPenulDatatransakss){
        $spreadsheet->getActiveSheet()->setCellValue('A'.$baseRow, $baseRow-11);
        // $spreadsheet->getActiveSheet()->setCellValue('A'.$baseRows, $baseRows-39);

        $spreadsheet->getActiveSheet()->setCellValue('B'.$baseRow, $ctkPenulDatatransakss->kode_kantor);
        //  $spreadsheet->getActiveSheet()->setCellValue('B'.$baseRows,$ctkPenulDatatransakss->kode_kantor );

        $spreadsheet->getActiveSheet()->setCellValue('C'.$baseRow, $ctkPenulDatatransakss->pib);
       //  $spreadsheet->getActiveSheet()->setCellValue('C'.$baseRows, $ctkPenulDatatransakss->pib);

        $spreadsheet->getActiveSheet()->setCellValue('D'.$baseRow, $ctkPenulDatatransakss->tglpib);
       //  $spreadsheet->getActiveSheet()->setCellValue('D'.$baseRows, $ctkPenulDatatransakss->tglpib);

      //

        $spreadsheet->getActiveSheet()->setCellValue('E'.$baseRow, $ctkPenulDatatransakss->npwp_imp);
       // $spreadsheet->getActiveSheet()->setCellValue('E'.$baseRows, $ctkPenulDatatransakss->npwp_imp);

        $spreadsheet->getActiveSheet()->setCellValue('F'.$baseRow, $ctkPenulDatatransakss->imp);
        //  $spreadsheet->getActiveSheet()->setCellValue('F'.$baseRows, $ctkPenulDatatransakss->imp);

        $spreadsheet->getActiveSheet()->setCellValue('G'.$baseRow, $ctkPenulDatatransakss->seri_brg);
        // $spreadsheet->getActiveSheet()->setCellValue('G'.$baseRows, $ctkPenulDatatransakss->bm_t_nilai_akhir);

        $spreadsheet->getActiveSheet()->setCellValue('H'.$baseRow, $ctkPenulDatatransakss->uraian_brg);
        $spreadsheet->getActiveSheet()->setCellValue('I'.$baseRow, $ctkPenulDatatransakss->hs);

        $spreadsheet->getActiveSheet()->setCellValue('J'.$baseRow, $ctkPenulDatatransakss->trf_bm);
      //  $spreadsheet->getActiveSheet()->setCellValue('J'.$baseRows, $ctkPenulDatatransakss->ppn_t_nilai_akhir);

        $spreadsheet->getActiveSheet()->setCellValue('K'.$baseRow, $ctkPenulDatatransakss->nilaipabean_awal);

      //  $spreadsheet->getActiveSheet()->setCellValue('K'.$baseRows, $ctkPenulDatatransakss->pph_t_nilai_akhir);


        $spreadsheet->getActiveSheet()->setCellValue('L'.$baseRow, $ctkPenulDatatransakss->hs_t);
       //    $spreadsheet->getActiveSheet()->setCellValue('L'.$baseRows, $ctkPenulDatatransakss->ppnbm_t_nilai_akhir);


        $spreadsheet->getActiveSheet()->setCellValue('M'.$baseRow, $ctkPenulDatatransakss->trf_bm_t);
       // $spreadsheet->getActiveSheet()->setCellValue('M'.$baseRows, $ctkPenulDatatransakss->denda);

        $spreadsheet->getActiveSheet()->setCellValue('N'.$baseRow, $ctkPenulDatatransakss->nilaipabean_akhir);

        $spreadsheet->getActiveSheet()->setCellValue('O'.$baseRow, '=O8');

        $baseRow++;
      }



      $vowel = array("&nbsp", ";", "â");
      $xanalisa_prosedur_rha = str_replace($vowel,' ',strip_tags($ctkPenulHeader -> analisa_prosedur_rha));


      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 4),'3')
      ->setCellValue('B'.(string)($baseRow + 4),  ($xanalisa_prosedur_rha));
      $spreadsheet->getActiveSheet()->mergeCells('B'.(string)($baseRow + 4).':N'.(string)($baseRow + 4));
      $spreadsheet->getActiveSheet()->getStyle('B'.(string)($baseRow + 4))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
      $spreadsheet->getActiveSheet()->getRowDimension((string)($baseRow + 4))->setRowHeight(60);

           

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 18),'NO.')
      ->setCellValue('B'.(string)($baseRow + 18),'KODE KANTOR')
      ->setCellValue('C'.(string)($baseRow + 18),'NOMOR')
      ->setCellValue('D'.(string)($baseRow + 18),'TANGGAL')
      ->setCellValue('E'.(string)($baseRow + 18),'NPWP')
      ->setCellValue('F'.(string)($baseRow + 18),'PERUSAHAAN')
      ->setCellValue('G'.(string)($baseRow + 18),'BEA MASUK')
      ->setCellValue('H'.(string)($baseRow + 18),'BMAD/BMI/BMP')
      ->setCellValue('I'.(string)($baseRow + 18),'BEA KELUAR')
      ->setCellValue('J'.(string)($baseRow + 18),'PPN')
      ->setCellValue('K'.(string)($baseRow + 18),'PPh')
      ->setCellValue('L'.(string)($baseRow + 18),'PPnBM')
      ->setCellValue('M'.(string)($baseRow + 18),'DENDA')
      ->setCellValue('N'.(string)($baseRow + 18),'TOTAL');
      

      $spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRow + 19),'1.')
      ->setCellValue('B'.(string)($baseRow + 19),'2')
      ->setCellValue('C'.(string)($baseRow + 19),'3')
      ->setCellValue('D'.(string)($baseRow + 19),'4')
      ->setCellValue('E'.(string)($baseRow + 19),'5')
      ->setCellValue('F'.(string)($baseRow + 19),'6')
      ->setCellValue('G'.(string)($baseRow + 19),'7')
      ->setCellValue('H'.(string)($baseRow + 19),'8')
      ->setCellValue('I'.(string)($baseRow + 19),'9')
      ->setCellValue('J'.(string)($baseRow + 19),'10')
      ->setCellValue('K'.(string)($baseRow + 19),'11')
      ->setCellValue('L'.(string)($baseRow + 19),'12')
      ->setCellValue('M'.(string)($baseRow + 19),'13')
      ->setCellValue('N'.(string)($baseRow + 19),'14');


      $baseRows= $baseRow +  20;
      foreach($ctkPenulDatatransaks as $ctkPenulDatatransaksss){

        $spreadsheet->getActiveSheet()->setCellValue('A'.$baseRows, $baseRows)
        ->setCellValue('B'.$baseRows,$ctkPenulDatatransaksss->kode_kantor )
        ->setCellValue('C'.$baseRows, $ctkPenulDatatransaksss->pib)
        ->setCellValue('D'.$baseRows, $ctkPenulDatatransaksss->tglpib)
       // ->setCellValue('E'.$baseRows, $ctkPenulDatatransaksss->npwp_imp)
        ->setCellValue('F'.$baseRows, $ctkPenulDatatransaksss->imp)
        ->setCellValue('G'.$baseRows, $ctkPenulDatatransaksss->bm_t_nilai_akhir)
        ->setCellValue('J'.$baseRows, $ctkPenulDatatransaksss->ppn_t_nilai_akhir)
        ->setCellValue('K'.$baseRows, $ctkPenulDatatransaksss->pph_t_nilai_akhir)
        ->setCellValue('L'.$baseRows, $ctkPenulDatatransaksss->ppnbm_t_nilai_akhir)
        ->setCellValue('M'.$baseRows, $ctkPenulDatatransaksss->denda)
        ->setCellValue('N'.$baseRows, $ctkPenulDatatransaksss->total_tagihan);
      //  ->getStyle('B'.$baseRows)->getFont()->setSize(11);
        $baseRows++;
      }

//$spreadsheet->getActiveSheet()->getStyle('G61')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Miscellaneous glyphs, UTF-8
      $spreadsheet->getActiveSheet()
      ->setCellValue('A10','NO.')
      ->setCellValue('B10','KODE KANTOR')
->setCellValue('C10','NOMOR')
->setCellValue('D10','TANGGAL')
->setCellValue('E10','NPWP')
->setCellValue('F10','PERUSAHAAN')
->setCellValue('G10','NO SERI BARANG')
->setCellValue('H10','URAIAN BARANG')
->setCellValue('I10','HS')
->setCellValue('J10','TARIF')
->setCellValue('K10','NILAI')
->setCellValue('L10','HS')
->setCellValue('M10','TARIF')
->setCellValue('N10','NILAI')
->setCellValue('O10','KET');

$spreadsheet->getActiveSheet()->setCellValue('A11','1.')
->setCellValue('B11','2')
->setCellValue('C11','3')
->setCellValue('D11','4')
->setCellValue('E11','5')
->setCellValue('F11','6')
->setCellValue('G11','7')
->setCellValue('H11','8')
->setCellValue('I11','9')
->setCellValue('J11','10')
->setCellValue('K11','11')
->setCellValue('L11','12')
->setCellValue('M11','13')
->setCellValue('N11','14')
->setCellValue('O11','15');



$spreadsheet->getActiveSheet()
->setCellValue('H1', 'KERTAS KERJA PENELITIAN ULANG')
->setCellValue('H2', $ctkPenulHeader ->kkp);

$spreadsheet->getActiveSheet()
->setCellValue('A3', 'A')
->setCellValue('B3', 'JENIS DOKUMEN')
->setCellValue('E3', $ctkJendok ->name)
->setCellValue('O3', 'ref_id-'.$ctkPenulHeader ->id);;

$spreadsheet->getActiveSheet()
->setCellValue('A4', 'B')
->setCellValue('B4', 'JENIS PELANGGARAN')
->setCellValue('E4', $ctkJenPelanggaran ->name);

$spreadsheet->getActiveSheet()
->setCellValue('A5', 'C')
->setCellValue('B5', 'DOKUMEN/BUKTI PENDUKUNG')
->setCellValue('E5', 'Dokumen pemberitahuan barang dan dokumen pendukung lainnya');

$spreadsheet->getActiveSheet()
->setCellValue('A7', 'D')
->setCellValue('B7', 'DATA TRANSAKSI');

$spreadsheet->getActiveSheet()->setCellValue('O6', $ctkJenPelanggaran->id)
->getStyle('O6')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

$spreadsheet->getActiveSheet()->setCellValue('O8', '=IF(O6 = 1,"salah tarif","salah nilai")')
->getStyle('O8')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);


$spreadsheet->getActiveSheet()
->setCellValue('G9', '=E3')
->setCellValue('F9', 'JENIS DOKUMEN')
->setCellValue('I9', 'DIBERITAHUKAN')
->setCellValue('L9', 'SEHARUSNYA');
$spreadsheet->getActiveSheet()->setCellValue('F'.(string)($baseRows + 1), 'TOTAL');

//$SUMRANGE = 'D2:D'.$i;
$baseRowG = $baseRow + 20;
$baseRows_t = $baseRows -1;

//$SUMRANGE = 'G'.$baseRowG.':G'.$baseRows - 1;

$SUMRANGE_bm = 'G'.$baseRowG.':G'.$baseRows_t;
$SUMRANGE_ppn = 'J'.$baseRowG.':J'.$baseRows_t;
$SUMRANGE_pph = 'K'.$baseRowG.':K'.$baseRows_t;
$SUMRANGE_total = 'G'.(string)($baseRows + 1).':M'.(string)($baseRows + 1);
$SUMROUNDUP_total = 'G'.(string)($baseRows + 2).':M'.(string)($baseRows + 2);
  // var_dump($SUMRANGE); 
  // die();
$spreadsheet->getActiveSheet()->setCellValue('G'.($baseRows + 1), '=SUM('.$SUMRANGE_bm.')')

->setCellValue('J'.($baseRows + 1), '=SUM('.$SUMRANGE_ppn.')')
->setCellValue('K'.($baseRows + 1), '=SUM('.$SUMRANGE_pph.')')
->setCellValue('N'.($baseRows + 1), '=SUM('.$SUMRANGE_total.')');


$spreadsheet->getActiveSheet()
->setCellValue('F'.(string)($baseRows + 2), 'PEMBULATAN')
->setCellValue('G'.(string)($baseRows + 2), '=ROUNDUP(G'.(string)($baseRows + 1).',-3)')
->setCellValue('J'.(string)($baseRows + 2), '=ROUNDUP(J'.(string)($baseRows + 1).',-3)')
->setCellValue('K'.(string)($baseRows + 2), '=ROUNDUP(K'.(string)($baseRows + 1).',-3)')
->setCellValue('N'.(string)($baseRows + 2), '=SUM('.$SUMROUNDUP_total.')');

$spreadsheet->getActiveSheet()->setCellValue('A'.(string)($baseRows + 4), 'SUMBER DATA : DOKUMEN')
->setCellValue('E'.(string)($baseRows + 4), $ctkJendok ->name);


$spreadsheet->getActiveSheet()->setCellValue('C'.(string)($baseRows + 8), 'Penyaji Data')
->setCellValue('G'.(string)($baseRows + 8), 'Analis 1')
->setCellValue('J'.(string)($baseRows + 8), 'Analis 2')
->setCellValue('M'.(string)($baseRows + 8), 'Analis 3');

$spreadsheet->getActiveSheet()->setCellValue('C'.(string)($baseRows + 12),  $ctkAnalisPenyaji1->name)
->setCellValue('G'.(string)($baseRows + 12), $ctkAnalis1->name)
->setCellValue('J'.(string)($baseRows + 12), $ctkAnalis2->name)
->setCellValue('M'.(string)($baseRows + 12), $ctkAnalis3->name);

        // Rename worksheet


$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);



$spreadsheet->getActiveSheet()->getStyle('A1:N'.(string)($baseRows + 13))->getFont()->setSize(12)
->setName('Arial');
$spreadsheet->getActiveSheet()->getStyle('A10:O11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('A'.(string)($baseRow + 18).':N'.(string)($baseRow + 19))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);



$styleThinBlackBorderOutline = [
  'borders' => [
    'allBorders' => [
      'borderStyle' => Border::BORDER_THIN,
      'color' => ['argb' => 'FF000000'],
    ],


  ],
];

$spreadsheet->getActiveSheet()->getStyle('A10:O'.(string)($baseRow))->applyFromArray($styleThinBlackBorderOutline);
$spreadsheet->getActiveSheet()->getStyle('A'.(string)($baseRow+18).':N'.(string)($baseRows))->applyFromArray($styleThinBlackBorderOutline);

$spreadsheet->getActiveSheet()->setTitle('KKP');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);




//same ending
$response = Yii::$app->getResponse();
$headers = $response->getHeaders();

$nf1 = "kkp_newREF_ID-".$ctkPenulHeader->id.".xlsx";
//var_dump($nf1); die;

            // Redirect output to a client’s web browser (Xlsx)
$headers->set('Content-Type', 'application/vnd.ms-excel');
$headers->set('Content-Disposition','attachment;filename='.$nf1);
//$headers->set('Content-Disposition','$nf1');
$headers->set('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
$headers->set('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
         $headers->set('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
         $headers->set('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
         $headers->set('Cache-Control: cache, must-revalidate'); // HTTP/1.1
         $headers->set('Pragma: public'); // HTTP/1.0
         ob_start();        
         $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
         $writer->save("php://output");
         $content = ob_get_contents();
         ob_clean();
         return $content;

      //  exit;





       }

     }
