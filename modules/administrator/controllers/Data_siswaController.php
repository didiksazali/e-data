<?php

namespace app\modules\administrator\controllers;

use app\gdrive\GDriveSetting;
use app\modules\administrator\models\general\DmSekolah;
use app\modules\administrator\models\general\Kelas;
use app\modules\administrator\models\general\RelasiKelasSiswa;
use app\modules\administrator\models\general\TahunAjaran;
use Yii;
use app\modules\administrator\models\general\DataSiswa;
use app\modules\administrator\models\search\DataSiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Data_siswaController implements the CRUD actions for DataSiswa model.
 */
class Data_siswaController extends Controller
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
     * Lists all DataSiswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataSiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataSiswa model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $tahunAjaran = TahunAjaran::findOne(['status'=>1]);
        $kelas= RelasiKelasSiswa::findOne(['uid_data_siswa'=> $model->uid_siswa, 'uid_tahun_ajaran'=>$tahunAjaran->uid_thn_ajaran]);
        $kelas= $kelas->uidKelas->nama_kelas;
        if(\Yii::$app->user->can('superUser')){
            $attributes=[

                'nis_siswa',
                'nisn_siswa',
                'nik_siswa',
                'nama_siswa',
                'jenis_kelamin_siswa',
                'tempat_lahir_siswa',
                'tanggal_lahir_siswa',
                [
                    'attribute'=>'kelas',
                    'value'=>$kelas,
                ],
                'hobi_siswa',
                'cita_cita_siswa',
                'alamat_domisili',
                'jarak_rumah_kesekolah',
                'no_telp_orangtua',
                'nama_ayah',
                'nama_ibu',
                'alamat_lengkap_orang_tua',

            ];
        }
        else{
            $attributes=[

                'nis_siswa',
                'nisn_siswa',
                'nik_siswa',
                'nama_siswa',
                'jenis_kelamin_siswa',
                'tempat_lahir_siswa',
                'tanggal_lahir_siswa',
                [
                    'attribute'=>'kelas',
                    'value'=>$kelas,
                ],
                'hobi_siswa',
                'cita_cita_siswa',
                'alamat_domisili',
                'jarak_rumah_kesekolah',
                'no_telp_orangtua',
                'nama_ayah',
                'nama_ibu',
                'alamat_lengkap_orang_tua',

            ];
        }

        return $this->render('view', [
            'model' => $model,
            'attributes'=> $attributes,
            'kelas'=> $kelas,
        ]);
    }

    /**
     * Creates a new DataSiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataSiswa();
        //$model->scenario='create';
        $sekolah= DmSekolah::find()->all();
        $uploadGDrive= new GDriveSetting();
        if($sekolah==NULL){
            $sek=[NULL=>'belum ada sekolah diinputkan'];
        }
        else{
            foreach ($sekolah as $key=> $item){
                $sek[$item->uid_dm_sekolah]=$item->nama;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $uid= $this->uidGenerator();
            $model->uid_siswa= $uid;
            $model->status_siswa=1;
            $model->gdrive_pasfoto_siswa='';
            $foto=0;
            if(UploadedFile::getInstance($model, 'help_foto')){
                $model->help_foto= UploadedFile::getInstance($model, 'help_foto');
                $tempPath = $model->help_foto->tempName;
                $type= $model->help_foto->type;
                $folder= Yii::$app->params['googleDrive']['folder']['general'];
                $foto=1;
            }


            if($model->validate()){
                if($foto!=0){
                    $id= $uploadGDrive->uploadGDrive($uid, $tempPath, $type, $folder, 'public');
                    $model->gdrive_pasfoto_siswa= $id;
                }

                if($model->save()){
                    //relasikan ke kelas
                    $tahunAjaran = TahunAjaran::findOne(['status'=>1]);
                    $relasi= new RelasiKelasSiswa();
                    $relasi->uid_data_siswa= $model->uid_siswa;
                    $relasi->uid_kelas= $model->kelas;
                    $relasi->uid_tahun_ajaran= $tahunAjaran->uid_thn_ajaran;
                    $relasi->create_by= \Yii::$app->user->getId();
                    $relasi->keterangan='ok';
                    if($relasi->save()){
                        return $this->redirect(['view', 'id' => $model->uid_siswa]);
                    }
                    else{
                        $siswa= DataSiswa::findOne($model->uid_siswa);
                        $siswa->delete();
                        print_r($relasi->getErrors());
                    }

                }
                else{
                    return $this->render('create', [
                        'model' => $model,
                        'sekolah' => $sek,
                    ]);
                }
            }
            else{
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
     * Updates an existing DataSiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sekolah= DmSekolah::find()->all();
        if($sekolah==NULL){
            $sek=[NULL=>'belum ada sekolah diinputkan'];
        }
        else{
            foreach ($sekolah as $key=> $item){
                $sek[$item->uid_dm_sekolah]=$item->nama;
            }
        }
        //get sekolah selected
        $tahunAjaran = TahunAjaran::findOne(['status'=>1]);
        $sekolah= RelasiKelasSiswa::findOne(['uid_data_siswa'=> $model->uid_siswa, 'uid_tahun_ajaran'=>$tahunAjaran->uid_thn_ajaran]);
        $model->sekolah= $sekolah->uidKelas->uid_sekolah;
        //get kelas from schooluid
        $kelas= Kelas::find()->where(['uid_sekolah'=>$sekolah->uidKelas->uid_sekolah])->all();
        if($kelas!=NULL){
            foreach ($kelas as $key=> $item){
                $kel[$item->uid_kelas]= $item->nama_kelas;
             }
        }
        else{
            $kel[NULL]='--tidak ada data kelas di inputkan--';
        }
        $model->kelas= $sekolah->uid_kelas;

        $kls_lama= $model->kelas;
        if ($model->load(Yii::$app->request->post())) {
            //if edit kelas
            if($kls_lama!= $model->kelas){
                $sekolah->uid_kelas= $model->kelas;
                $sekolah->save();
            }
            //jika update foto
            if($model->help_foto=UploadedFile::getInstance($model, 'help_foto')){
                $uploadGDrive=new GDriveSetting();
                $tempPath = $model->help_foto->tempName;
                $type= $model->help_foto->type;
                $folder= Yii::$app->params['googleDrive']['folder']['general'];
                $id= $uploadGDrive->uploadGDrive($model->uid_siswa, $tempPath, $type, $folder, 'public');
                $model->gdrive_pasfoto_siswa=$id;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->uid_siswa]);
            }
            else{

            }

        } else {
            return $this->render('update', [
                'model' => $model,
                'sekolah'=> $sek,
                'kelas'=> $kel,
            ]);
        }
    }

    /**
     * Deletes an existing DataSiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        $id= @$_POST['id'];
        if($this->findModel($id)->delete()){
            echo 1;
        }
        else{
            echo 0;
        }

        return $this->redirect(['index']);
    }

    public function actionGet_kelas(){
        if(\Yii::$app->user->can('app/administrator/data_siswa/create')||\Yii::$app->user->can('app/administrator/data_siswa/update')){
            $template= Kelas::find()->where(['uid_sekolah'=>@$_POST['id']])->all();
            echo '<select id="datasiswa-kelas" class="form-control show-tick" data-live-search="true" name="DataSiswa[kelas]" >';
            echo '<option value=NULL>PILIH SATU</option>';
            foreach ($template as $key=> $item){
                echo '<option value="'.$item->uid_kelas.'">'.$item->nama_kelas.'</option>';
            }
            echo "</select>";
        }
        else{
            echo "you have not access here, sorry guys...";
        }
    }

    public function uidGenerator(){
        return $uid=uniqid('siswa_');
    }

    public  function actionGet_foto(){
        $gdrive= new GDriveSetting();
        echo $gdrive->readGDriveOne(@$_POST['id']);
    }

    /**
     * Finds the DataSiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DataSiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataSiswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
