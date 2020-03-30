<?php

namespace app\modules\administrator\controllers;

use app\gdrive\GDriveSetting;
use app\modules\administrator\models\general\DataSiswa;
use app\modules\administrator\models\general\DmSekolah;
use app\modules\administrator\models\general\Staf;
use app\modules\administrator\models\general\StafJenisSurat;
use app\modules\administrator\models\general\TahunAjaran;
use app\modules\administrator\models\search\StafBuatSuratSearch;
use Yii;
use app\modules\administrator\models\general\StafBuatSurat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Buat_suratController implements the CRUD actions for StafBuatSurat model.
 */
class Buat_suratController extends Controller
{
    public $layout='material_adv';
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
     * Lists all StafBuatSurat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StafBuatSuratSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StafBuatSurat model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model= $this->findModel($id);
        if(\Yii::$app->user->can('superUser')){
            $attributes=[   'uid_buat_surat',
                            'no_urut',
                            'no_surat',
                            [
                                'attribute'=> 'Jenis Surat',
                                'value'=>$model->uidJenisSurat->nama_jenis_surat,
                            ],
                            [
                                'attribute'=> 'Nama Siswa',
                                'value'=>$model->uidDataSiswa->nama_siswa,
                            ],
                            [
                                'attribute'=> 'NIS/ NISN',
                                'value'=>$model->uidDataSiswa->nis_siswa.'/ '.$model->uidDataSiswa->nisn_siswa,
                            ],
                            [
                                'attribute'=> 'Sekolah',
                                'value'=>$model->uidJenisSurat->uidTemplateSurat->uidUntukSekolah->nama,
                            ],
                            [
                                'attribute'=> 'estimasi_selesai',
                                'format'=>'raw',
                                'value'=>$estimasi_selesai_tanggal,
                            ],
                            [
                                'attribute'=> 'biaya_optional',
                                'value'=>'Rp. '.$model->biaya_optional,
                            ],
                            [
                                'attribute'=> 'status_selesai',
                                'format'=>'raw',
                                'value'=>$model->status_selesai!=1?'<span class="label bg-pink">Belum Selesai</span> &nbsp; <a href="'.Yii::$app->homeUrl.'administrator/buat_surat/surat_selesai?id='.$model->uid_buat_surat.'">Tandai Sudah Selesai?</a>':'<span class="label bg-blue">Sudah Selesai</span>&nbsp <span id="'.$model->uid_buat_surat.'" class="delete-archive" style="cursor: pointer; color: red">Hapus Dari Arsip?</span>',
                            ],
                            [
                                'attribute'=> 'Dibuat Oleh',
                                'value'=>$model->createBy->username,
                            ],
                            [
                                'attribute'=> 'Dibuat Pada',
                                'value'=>date('d-m-Y', strtotime($model->create_at)),
                            ],

                            'attribute_tambahan_optional:ntext',
                            'update_at'
                        ];
        }
        else{
            $date= date('d-m-Y', strtotime($model->estimasi_selesai_tanggal));
            $now= date('d-m-Y');
            $datetime1 = new \DateTime($date);
            $datetime2 = new \DateTime($now);
            $difference = $datetime1->diff($datetime2);
            $estimasi_selesai_tanggal= $date<$now?''.$date.' &nbsp;<span class="label bg-pink">Sudah Lewat</span>':''.$date.' &nbsp;<span class="label bg-blue">'.$difference->days.' hari lagi</span>';


            $attributes=[   'no_surat',
                            [
                            'attribute'=> 'Jenis Surat',
                            'value'=>$model->uidJenisSurat->nama_jenis_surat,
                            ],

                            [
                                'attribute'=> 'Nama Siswa',
                                'value'=>$model->uidDataSiswa->nama_siswa,
                            ],
                            [
                                'attribute'=> 'NIS/ NISN',
                                'value'=>$model->uidDataSiswa->nis_siswa.'/ '.$model->uidDataSiswa->nisn_siswa,
                            ],
                            [
                                'attribute'=> 'Sekolah',
                                'value'=>$model->uidJenisSurat->uidTemplateSurat->uidUntukSekolah->nama,
                            ],
                            [
                                'attribute'=> 'estimasi_selesai',
                                'format'=>'raw',
                                'value'=>$estimasi_selesai_tanggal,
                            ],
                            [
                                'attribute'=> 'biaya_optional',
                                'value'=>'Rp. '.$model->biaya_optional,
                            ],
                            [
                                'attribute'=> 'status_selesai',
                                'format'=>'raw',
                                'value'=>$model->status_selesai!=1?'<span class="label bg-pink">Belum Selesai</span> &nbsp; <a href="'.Yii::$app->homeUrl.'administrator/buat_surat/surat_selesai?id='.$model->uid_buat_surat.'">Tandai Sudah Selesai?</a>':'<span class="label bg-blue">Sudah Selesai</span>&nbsp <span id="'.$model->uid_buat_surat.'" class="delete-archive" style="cursor: pointer; color: red">Hapus Dari Arsip?</span>',
                            ],
                            [
                                'attribute'=> 'Dibuat Oleh',
                                'value'=>$model->createBy->username,
                            ],
                            [
                                'attribute'=> 'Dibuat Pada',
                                'value'=>date('d-m-Y', strtotime($model->create_at)),
                            ],
                                    ];
        }
        $gdrive= new GDriveSetting();
        $doc=$gdrive->readGDriveOne($model->gdrive_scan_document);
        return $this->render('view', [
            'model' => $model,
            'attributes'=> $attributes,
            'read_document'=> $doc,
        ]);
    }

    /**
     * Creates a new StafBuatSurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StafBuatSurat();

        $sekolah= DmSekolah::find()->all();
        $model->scenario='create';
        if($sekolah==NULL){
            $sek=[NULL=>'belum ada sekolah diinputkan'];
        }
        else{
            foreach ($sekolah as $key=> $item){
                $sek[$item->uid_dm_sekolah]=$item->nama;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->uid_buat_surat= $this->uidGenerator();
            $model->no_urut= $this->getNoUrut($model->uid_jenis_surat);
            $model->no_surat= $this->getNoSurat($model->uid_jenis_surat);
            $model->attribute_tambahan_optional='';
            $model->create_by= Yii::$app->user->identity->getId();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->uid_buat_surat]);
            }
            else{
                print_r($model->getErrors());
                exit();
                return $this->render('create', [
                    'model' => $model,
                    'sekolah' => $sek,
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'sekolah' => $sek,
            ]);
        }
    }

    /**
     * Updates an existing StafBuatSurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario='update';
        $sekolah= DmSekolah::find()->all();
        if($sekolah==NULL){
            $sek=[NULL=>'belum ada sekolah diinputkan'];
        }
        else{
            foreach ($sekolah as $key=> $item){
                $sek[$item->uid_dm_sekolah]=$item->nama;
            }
        }
        $model->sekolah= $model->uidJenisSurat->uidTemplateSurat->uidUntukSekolah->uid_dm_sekolah;
        $jenis_surat= StafJenisSurat::find()->joinWith('uidTemplateSurat.uidUntukSekolah')->where(['dm_sekolah.uid_dm_sekolah'=>$model->sekolah])->all();

        if($jenis_surat==NULL){
            $sek=[NULL=>'belum ada jenis surat diinputkan'];
        }
        else{
            foreach ($jenis_surat as $key=> $item){
                $jen[$item->uid_jenis_surat]=$item->nama_jenis_surat;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid_buat_surat]);
        } else {
            if($model->status_selesai==1){
                return $this->renderPartial('/default/cant_access');
            }
            else{
                return $this->render('update', [
                    'model' => $model,
                    'sekolah'=> $sek,
                    'jenis_surat'=> $jen,
                ]);
            }

        }
    }

    /**
     * Deletes an existing StafBuatSurat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        $id=@$_POST['id'];
        if($this->findModel($id)->delete()){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function actionSurat_selesai($id){
        $model = $this->findModel($id);
        $model->scenario = 'tandai_selesai';
        $uploadGDrive= new GDriveSetting();
        if($model!=NULL){
            if($model->load(Yii::$app->request->post())){
                $model->help_upload_scan=UploadedFile::getInstance($model, 'help_upload_scan');
                $tempPath = $model->help_upload_scan->tempName;
                $type= $model->help_upload_scan->type;
                $folder= Yii::$app->params['googleDrive']['folder']['general'];
                $model->gdrive_scan_document=$id;
                $model->tanggal_selesai= date('Y-m-d');
                if($model->validate()){
                    $id_gd= $uploadGDrive->uploadGDrive($id, $tempPath, $type, $folder, 'public');
                    $model->gdrive_scan_document=$id_gd;
                    $model->status_selesai=1;
                    if($model->save()){
                        Yii::$app->session->setFlash('upload_success', "Surat ini telah ditandai selesai dan dimasukkan kedalam arsip");
                        return $this->redirect(['view', 'id' => $model->uid_buat_surat]);
                    }
                    else{
                        Yii::$app->session->setFlash('upload_unsuccess', "Oups, ada kesalahan... coba lagi");
                        return $this->render('_form_done', [
                            'model' => $model,
                        ]);
                    }
                }
                else{
                    Yii::$app->session->setFlash('upload_unsuccess', "Oups, ada kesalahan... coba lagi");
                    return $this->render('_form_done', [
                        'model' => $model,
                    ]);
                }
            }
            return $this->render('_form_done', [
                'model' => $model,
            ]);
        }
        else{

        }

    }

    public function actionDelete_archive()
    {
        $id=@$_POST['id'];
        $model=$this->findModel($id);
        if($model!=NULL){
            $model->status_selesai=0;
            if($model->save()){
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            echo 0;
        }
    }

    public function actionDownload_surat($uid){
        $data= $this->dataReplace($uid);
        $dataForReplace= $data['dataForReplace'];
        $dataReplace= $data['dataReplace'];

        $surat= StafBuatSurat::findOne($uid);
        if($surat!=NULL){
            $path= $surat->uidJenisSurat->uidTemplateSurat->path_template;
            $fileToModify = 'word/document.xml';
            $zip= new \ZipArchive();
            $tempPath= 'document/template-surat/pathTemp/'.$surat->uid_buat_surat.'.docx';

            //make file name
            $fileName= $surat->uidJenisSurat->nama_jenis_surat.'-'.$surat->uidDataSiswa->nama_siswa.'( '.$surat->uidDataSiswa->nis_siswa.' ).docx';

            //copy untukmendapatkan file yang di edit
            copy($path, $tempPath);
            if ($zip->open($tempPath) === TRUE) {
                //Read contents into memory
                $oldContents = $zip->getFromName($fileToModify);
                //Modify contents:
                //$regex = "/( { ( (?: [^{}]* | (?1) )* ) } )/x";
                //preg_match_all($regex, $oldContents, $matches);
                //$datas = $matches[2];
                $newContents = $oldContents;

                foreach ($dataForReplace as $key=> $dat){
                    $newContents = str_replace("{".$dat."}",$dataReplace[$dat], $newContents);
                }

                //Delete the old...
                $zip->deleteName($fileToModify);
                //Write the new...
                $zip->addFromString($fileToModify, $newContents);
                //And write back to the filesystem.
                $return = $zip->close();
                If ($return == TRUE) {
                    header('Content-Description: File Transfer');
                    header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                    header('Content-Disposition: attachment; filename="'.$fileName.'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($tempPath));
                    ob_clean();
                    flush();
                    readfile($tempPath);
                    //delete file copy
                    unlink($tempPath);
                }else{
                    echo $return;
                }
            }
        }
        else{

        }

    }

    public function dataReplace($uid_buat_surat){
        $bulan= [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];
        $surat= StafBuatSurat::findOne($uid_buat_surat);
        $dataForReplace= [
                            'no_surat',
                            'nama_siswa',
                            'tempat_lahir_siswa',
                            'tanggal_lahir_siswa',
                            'nis_siswa',
                            'nisn_siswa',
                            'nama_wali_siswa',
                            'nama_ibu_siswa',
                            'alamat_siswa',
                            'nama_sekolah',
                            'tahun_ajaran_aktif',
                            'tanggal_sekarang',
                            'nama_kepala_sekolah',
                            'jabatan_kepala_sekolah',
                            'kelas_siswa',
                            'tahun_sekarang',
                            'alamat_lengkap_orangtua_siswa',
                            'pekerjaan_ayah_siswa',
                        ];
        $dataReplace=[];

        //nomor surat
        $dataReplace['no_surat']= $surat->no_surat;
        //data_siswa
        $dataReplace['nama_siswa']= strtoupper($surat->uidDataSiswa->nama_siswa);
        $dataReplace['tempat_lahir_siswa']= $surat->uidDataSiswa->tempat_lahir_siswa;
        $dataReplace['tanggal_lahir_siswa']= $surat->uidDataSiswa->tanggal_lahir_siswa!=''?date("d ", strtotime($surat->uidDataSiswa->tanggal_lahir_siswa)).' '.$bulan[(int)date("m ", strtotime($surat->uidDataSiswa->tanggal_lahir_siswa))].' '.date("Y ", strtotime($surat->uidDataSiswa->tanggal_lahir_siswa)):'-';
        $dataReplace['nis_siswa']= $surat->uidDataSiswa->nis_siswa!=''?$surat->uidDataSiswa->nis_siswa:'-';
        $dataReplace['nisn_siswa']= $surat->uidDataSiswa->nisn_siswa!=''?$surat->uidDataSiswa->nisn_siswa:'-';
        $dataReplace['nama_wali_siswa']= $surat->uidDataSiswa->nama_ayah!=''?$surat->uidDataSiswa->nama_ayah:$surat->uidDataSiswa->nama_wali!=''?$surat->uidDataSiswa->nama_wali:$surat->uidDataSiswa->nama_ibu!=''?$surat->uidDataSiswa->nama_ibu:'................................';
        $dataReplace['alamat_siswa']= ucwords($surat->uidDataSiswa->jenis_tempat_tinggal==1?$surat->uidDataSiswa->alamat_domisili: $surat->uidDataSiswa->alamat_lengkap_orang_tua!=''?$surat->uidDataSiswa->alamat_lengkap_orang_tua:'................................');
        $dataReplace['nama_ibu_siswa']= $surat->uidDataSiswa->nama_ibu!=''?$surat->uidDataSiswa->nama_ibu:'................................';
        $dataReplace['alamat_lengkap_orangtua_siswa']= $surat->uidDataSiswa->alamat_lengkap_orang_tua!=''?$surat->uidDataSiswa->alamat_lengkap_orang_tua:'................................';
        $dataReplace['pekerjaan_ayah_siswa']= '................................';
        //kelas siswa
        $kelas= 'BELUM DI SETTTING';
        $dataReplace['kelas_siswa']=$kelas; //$surat->uidDataSiswa->relasiKelasSiswaOne->uidKelas->nama_kelas;
        //tanggal_sekarang
        $dataReplace['tanggal_sekarang']= date('d').' '.$bulan[date('m')+0].' '.date('Y');
        //nama_sekolah
        $dataReplace['nama_sekolah']=$surat->uidJenisSurat->uidTemplateSurat->uidUntukSekolah->nama;
        //tahun_ajaran_aktif
        $tahunAjaran= TahunAjaran::findOne(['status'=>1]);
        $dataReplace['tahun_ajaran_aktif']=$tahunAjaran->nama;
        //jabatan
        $getJenjang= DmSekolah::findOne(['jenjang_sekolah'=>$surat->uidJenisSurat->uidTemplateSurat->uidUntukSekolah->jenjang_sekolah]);
        $staf= Staf::findOne(['jabatan'=>'KASEK.'.$getJenjang->jenjang_sekolah]);
        $dataReplace['nama_kepala_sekolah']= strtoupper($staf->nama);
        $dataReplace['jabatan_kepala_sekolah']= $staf->jabatanStaf->nama_jabatan;
        //tahun sekarang
        $dataReplace['tahun_sekarang']= date('Y');

        return $data=['dataForReplace'=> $dataForReplace, 'dataReplace'=> $dataReplace];
    }

    public function actionGet_siswa(){
        $siswa= DataSiswa::find()->where(['like', 'nama_siswa', @$_POST['id']])->all();
        foreach ($siswa as $key=> $item) {
            //
        }
    }

    public function actionGet_jenis_surat(){
        $jenis= StafJenisSurat::find()->joinWith('uidTemplateSurat')->where(['staf_jenis_surat.status'=>1])->andWhere(['staf_template_surat.uid_untuk_sekolah'=>@$_POST['id']])->all();
        echo '<select class="form-control show-tick" id="stafbuatsurat-uid_jenis_surat" data-live-search="true" name="StafBuatSurat[uid_jenis_surat]">';
        echo '<option>--Pilih Satu--</option>';
        foreach ($jenis as $key=> $item) {
            echo '<option value="'.$item->uid_jenis_surat.'">'.$item->nama_jenis_surat.'</option>';
        }
        echo '</select>';
    }

    public function actionGet_siswa_json(){
        if(\Yii::$app->user->can('app/administrator/surat_masuk/create')||\Yii::$app->user->can('app/administrator/surat_masuk/update')) {
            $key = @$_POST['q'];
            $query1 = DataSiswa::find()->joinWith('relasiKelasSiswas.uidKelas')->andWhere(['kelas.uid_sekolah'=>$_POST['uid_sekolah']]);

            $siswa= $query1->andWhere([
                'or',
                ['like', 'nama_siswa', $key],
                ['like', 'nis_siswa', $key],
                ['like', 'nisn_siswa', $key],
                ['like', 'tanggal_lahir_siswa', $key]
            ])->all();
            /////////////////////////////////////////

            if ($siswa != NULL) {
                foreach ($siswa as $key => $item) {
                    $sis[] = ['uid_siswa' => $item->uid_siswa, 'nama_siswa' => $item->nama_siswa, 'nis_siswa' => $item->nis_siswa];
                }
            } else {
                $sis[0] = ['uid_siswa' => '', 'nama_siswa' => '-- not found --', 'nis_siswa' => 'no data for return'];
            }

            print_r(json_encode($sis));

        }
        else{
            echo -1;
        }

    }

    public function actionGet_data_siswa_json(){
        $item= DataSiswa::findOne(@$_POST['id']);
        $sis[] = ['uid_siswa' => $item->uid_siswa, 'nama_siswa' => $item->nama_siswa, 'nis_siswa' => $item->nis_siswa];

        echo json_encode($sis);
    }

    public  function actionGet_document(){
        $gdrive= new GDriveSetting();
        echo $gdrive->readGDriveOne(@$_POST['id']);
    }

    public function uidGenerator(){
        return $uid=uniqid('buat_srt');
    }

    private function getNoUrut($jns_surat){
        //getSekolah
        $jenisSurat= StafJenisSurat::findOne($jns_surat);
        $sekolah= $jenisSurat->uidTemplateSurat->uidUntukSekolah->uid_dm_sekolah;

        //get max of number latter from the school
        $query= StafBuatSurat::find()->joinWith('uidJenisSurat.uidTemplateSurat.uidUntukSekolah')->where(['dm_sekolah.uid_dm_sekolah'=>$sekolah]);
        $check= $query->all();
        if($check!=NULL){
            $max= $query->max('no_urut');
            return (($max)+1);
        }
        else{
            return 1;
        }

    }

    private function getNoSurat($jns_surat){
        //get format
        $jenisSurat= StafJenisSurat::findOne($jns_surat);
        $no_surat= $jenisSurat->no_surat;

        //data for replace
        $dataForReplace= ['no_urut', 'bulan_sekarang_romawi', 'tahun_sekarang_dua_digit', 'tahun_sekarang_empat_digit'];

        //replace with
        $dataReplace['no_urut']=$this->getNoUrut($jns_surat);
        $dataReplace['bulan_sekarang_romawi']=$this->monthToRoman((int)date('m'));
        $dataReplace['tahun_sekarang_dua_digit']= date('y');
        $dataReplace['tahun_sekarang_empat_digit']= date('Y');

        foreach ($dataForReplace as $key=>$item){
            $no_surat=str_replace('{'.$item.'}', $dataReplace[$item], $no_surat);
        }
        return trim($no_surat);
    }

    public function actionGet_info_json(){
        $jenis_surat= StafJenisSurat::findOne(@$_POST['id']);
        if($jenis_surat!=NULL){
                $data['estimasi_selesai']= date( 'Y-m-d', strtotime("+".$jenis_surat->estimasi_selesai." day", time()));
                $data['biaya']= $jenis_surat->biaya;
        }
        else{
            $data['estimasi_selesai']= 'not define';
            $data['biaya']= 'not define';
        }

        print_r(json_encode($data));
    }

    /**
     * Finds the StafBuatSurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StafBuatSurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StafBuatSurat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

private function monthToRoman($month)
{
   switch ($month){
       case 1:
           return 'I';
           break;
       case 2:
           return 'II';
           break;
       case 3:
           return 'III';
           break;
       case 4:
           return 'IV';
           break;
       case 5:
           return 'V';
           break;
       case 6:
           return 'VI';
           break;
       case 7:
           return 'VII';
           break;
       case 8:
           return 'VIII';
           break;
       case 9:
           return 'IX';
           break;
       case 10:
           return 'X';
           break;
       case 11:
           return 'XI';
           break;
       case 12:
           return 'XII';
           break;

   }
}
}
