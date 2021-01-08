public function actionCetaksurat($id)
    {
       
      
       $ctksrt = \app\models\SkaMasterRetroReject::findOne($id);
       $unitpenerbit = \app\models\base\SkaUnitpenerbit::find()->where (['id'=>$ctksrt->unit_penerbit_fk])->all();
       $issuingcountry = \app\models\base\SkaIssuingCountry::find()->where (['id'=>$ctksrt->id_issuing_country])->all();
       $issuingauthorities = \app\models\base\SkaIssuingAuthorities::find()->where (['id'=>$ctksrt->id_issuing_authorities])->all();
       $skalist = \app\models\base\SkaList::find()->where (['id'=>$ctksrt->skema_fta])->all();
       $skapejabat = \app\models\base\SkaPejabat::find()->where (['id'=>$ctksrt->namapej_ttd])->all();

       //$skaretroactivedetail = \app\models\base\SkaRetroactiveDetail::find()->where (['id'=>$ctksrt->id_link])->all();
       // $skakriteriaroo = \app\models\base\SkaKriteriaRoo::find()->where (['id'=>$skaretroactivedetail->kriteria_roo_fk])->all();
       // $kkakriteriaspesifik = \app\models\base\SkaKriteriaSpesifik::find()->where (['id'=>$skaretroactivedetail->kriteria_spesifik_fk])->all();
       // $skareasonlist = \app\models\base\SkaReasonlist::find()->where (['id'=>$skaretroactivedetail->kriteria_spesifik_fk])->all();

       // $skakriteriaroo = \app\models\base\SkaKriteriaRoo::find()->where (['id'=>$ctksrtdetail->kriteria_roo_fk])->all();
       // $skakriteriaspesifik = \app\models\base\SkaKriteriaSpesifik::find()->where (['id'=>$ctksrtdetail->kriteria_spesifik_fk])->all();
       // $skareasonlist = \app\models\base\SkaReasonlist::find()->where (['id'=>$ctksrtdetail->kriteria_spesifik_fk])->all();

//SkaRetroactiveDetail
      //  $n= $ctksrt -> ska_nomor;

       // Initalize the TBS instance
         $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
         $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/srt_rejectska_template.docx';
         $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
         $OpenTBS->VarRef['xjenis_reference']=$ctksrt -> jenis_reference;
         $OpenTBS->VarRef['xno_srtpemberitahuan']= $ctksrt -> no_srtpemberitahuan;
         $OpenTBS->VarRef['xtgl_srtpemberitahuan']=$ctksrt -> tgl_srtpemberitahuan;
         $OpenTBS->VarRef['xska_nomor']= $ctksrt -> ska_nomor;
         $OpenTBS->VarRef['xskatglterbit']=$ctksrt -> ska_tgl_terbit;
         $OpenTBS->VarRef['xska_jml_item_tercantum']= $ctksrt -> ska_jml_item_tercantum;
         $OpenTBS->VarRef['xska_jml_item_tidaksesuai']= $ctksrt-> ska_jml_item_tidaksesuai;
         // $OpenTBS->VarRef['xnobpj']= $ctksrt -> nomorbpj_sspcp;
         // $OpenTBS->VarRef['xtglbpj']= $ctksrt-> tglbpj_sspcp;
         // $OpenTBS->VarRef['xtgljatuhtempo']= $ctksrt -> tgljatuhtempo;
         // $OpenTBS->VarRef['xtglagms']= $ctksrt -> tglagenda;
         // $OpenTBS->VarRef['xformalaju']=$ctksrt -> formalaju;
         // $OpenTBS->VarRef['xpendpt']=$ctksrt -> pendpt;
         

          $b111 = [];
          foreach($issuingauthorities as $issuingauthoritiesb1){
            $b111[] = [
           // 'id' => $ctksrtb1 -> id,
             'name_authorities'=>$issuingauthoritiesb1-> name_authorities,
              //  'npwpimp'=>$daftarimportirb1-> npwpimp,
                    ];
                  }       
         $OpenTBS->MergeBlock('a111' ,$b111);

         
        $b555 = [];
          foreach($issuingcountry as $issuingcountrys){
            $b555[] = [
            // 'nip'=>$namapemeriksas-> nip,
                'name'=>$issuingcountrys->name,
                    ];
                  }
        $OpenTBS->MergeBlock('b444' ,$b555);

        $b556 = [];
          foreach($skalist as $skalists){
            $b556[] = [
                'ska_form'=>$skalists->ska_form,
                'skema_fta1'=>$skalists->skema_fta,
                    ];
                  }
        $OpenTBS->MergeBlock('b445' ,$b556);
        $OpenTBS->MergeBlock('a445' ,$b556);


        $b557 = [];
          foreach($unitpenerbit as $unitpenerbits){
            $b557[] = [
            // 'nip'=>$namapemeriksas-> nip,
                'unit_penerbit_en'=>$unitpenerbits->unit_penerbit_en ,
                    ];
                  }
        $OpenTBS->MergeBlock('b446' ,$b557);

        $b558 = [];
          foreach($skapejabat as $skapejabats){
            $b558[] = [
               'nama_pejabat'=>$skapejabats->nama_pejabat,
                    ];
                  }
        $OpenTBS->MergeBlock('b447' ,$b558);
        

       // var_dump($id);
       // var_dump($issuingcountrys->name);
       // var_dump($issuingauthoritiesb1->name_authorities);
      //  var_dump($ctksrt ->jenis_reference);
       //  var_dump($unitpenerbits->unit_penerbit_en);
       // var_dump($skalists->skema_fta);
       //  die( ) ;


        $OpenTBS->Show(OPENTBS_DOWNLOAD, 'letterRetRej'.$n.'.docx'); // Also merges all [onshow] automatic fields.  
        exit;
         //return $this -> reload();
         return $ctksrt->renderAjax();
    } 