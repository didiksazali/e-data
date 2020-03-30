<?php

namespace app\modules\administrator\controllers;

use app\gdrive\GDriveSetting;
use app\modules\administrator\models\general\DmSekolah;
use app\modules\administrator\models\general\Staf;
use app\modules\administrator\models\general\StafKategoriSurat;
use Yii;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\modules\administrator\models\general\StafSuratMasuk;
use app\modules\administrator\models\search\StafSuratMasukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Surat_masukController implements the CRUD actions for StafSuratMasuk model.
 */
class Surat_masukController extends Controller
{
    public $layout='material_adv';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StafSuratMasuk models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('app/administrator/surat_masuk/index')){
            $searchModel = new StafSuratMasukSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    public function actionIndex_2()
    {
        if(\Yii::$app->user->can('app/administrator/surat_masuk/index')){
            $searchModel = new StafSuratMasukSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index_2', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    /**
     * Displays a single StafSuratMasuk model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('app/administrator/surat_masuk/view')){

            $model=$this->findModel($id);
            if(\Yii::$app->user->can('superUSer')){
                $attributes = [
                    'uid_surat_masuk',
                    'no_surat',
                    'tanggal_masuk',
                    'dari',
                    'id_google_drive',
                    [
                        'attribute'=>'tujuan_surat_kesekolah',
                        'value'=>$model->tujuanSuratKesekolah->nama,
                    ],
                    'maksud_surat',
                    [
                        'attribute'=>'uid_kategori_surat',
                        'value'=>$model->uidKategoriSurat->nama_kategori,
                    ],
                    [

                        'attribute'=>'tindakan_yang_harus_dilakukan',
                        'value'=>$model->tindakan_yang_harus_dilakukan==''?'tidak ada':$model->tindakan_yang_harus_dilakukan,
                    ],
                    [

                        'attribute'=>'estimasi_batas_tindakan',
                        'value'=>$model->tindakan_yang_harus_dilakukan!=''?$model->estimasi_batas_tindakan:'-',
                    ],
                    [

                        'attribute'=>'beban_kerja_kepada',
                        'value'=>$model->beban_kerja_kepada!=NULL?$model->bebanKerjaKepada->nama:'-',
                    ],
                    [
                        'attribute'=>'create_by',
                        'value'=>$model->createBy->username,
                    ],
                    'create_at',
                    'update_at',
                ];
            }
            else{
                $attributes = [
                    'no_surat',
                    'tanggal_masuk',
                    'dari',
                    [
                        'attribute'=>'tujuan_surat_kesekolah',
                        'value'=>$model->tujuanSuratKesekolah->nama,
                    ],
                    'maksud_surat',
                    [
                        'attribute'=>'uid_kategori_surat',
                        'value'=>$model->uidKategoriSurat->nama_kategori,
                    ],
                    [

                        'attribute'=>'tindakan_yang_harus_dilakukan:ntext',
                        'value'=>$model->tindakan_yang_harus_dilakukan==''?'tidak ada':$model->tindakan_yang_harus_dilakukan,
                    ],
                    [

                        'attribute'=>'estimasi_batas_tindakan',
                        'value'=>$model->tindakan_yang_harus_dilakukan!=''?$model->estimasi_batas_tindakan:'-',
                    ],
                    [

                        'attribute'=>'beban_kerja_kepada',
                        'value'=>$model->beban_kerja_kepada!=NULL?$model->bebanKerjaKepada->nama:'-',
                    ],
                ];

            }
            return $this->render('view', [
                'model' => $this->findModel($id),
                'attributes'=> $attributes,
            ]);
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }
    }

    /**
     * Creates a new StafSuratMasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('app/administrator/surat_masuk/create')){
            $model = new StafSuratMasuk();
            $model->scenario = 'create';
            $uploadGDrive= new GDriveSetting();

            $kategori_surat= StafKategoriSurat::find()->all();
            if($kategori_surat==NULL){
                $kat=[NULL=>'belum ada kategori diinputkan'];
            }
            else{
                foreach ($kategori_surat as $key=> $item){
                    $kat[$item->uid_kategori_surat]=$item->nama_kategori;
                }
            }

            $sekolah= DmSekolah::find()->all();
            if($sekolah==NULL){
                $sek=[NULL=>'belum ada sekolah diinputkan'];
            }
            else{
                foreach ($sekolah as $key=> $item){
                    $sek[$item->uid_dm_sekolah]=$item->nama;
                }
            }

            $staf= Staf::find()->all();
            if($staf==NULL){
                $stf=[NULL=>'belum ada staf diinputkan'];
            }
            else{
                foreach ($staf as $key=> $item){
                    $stf[$item->uid_staf]=$item->nama;
                }
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->document_scan= UploadedFile::getInstance($model, 'document_scan');
                $uid = $this->uidGenerator();
                $tempPath = $model->document_scan->tempName;
                $type= $model->document_scan->type;
                $folder= Yii::$app->params['googleDrive']['folder']['general'];
                $model->uid_surat_masuk= $uid;
                $model->id_google_drive=$uid;
                $model->create_by= Yii::$app->user->identity->getId();

                if((@$_POST['check_helper'])==0){
                    $model->beban_kerja_kepada=NULL;
                    $model->tindakan_yang_harus_dilakukan='';
                }
                else{
                    //get uid staf
                    $stafuid= Staf::findOne(['hak_akses'=>Yii::$app->user->identity->getId()]);
                    $model->beban_kerja_kepada= $model->beban_kerja_kepada==NULL||$model->beban_kerja_kepada==''?$stafuid->uid_staf:$model->beban_kerja_kepada;
                }

                if($model->validate()){
                    $id= $uploadGDrive->uploadGDrive($uid, $tempPath, $type, $folder, 'public');
                    $model->id_google_drive= $id;
                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->uid_surat_masuk]);
                    }
                    else{
                        return $this->render('create', [
                            'model' => $model,
                            'kategori_surat'=> $kat,
                            'sekolah'=> $sek,
                            'beban_kerja_kepada'=> $stf,
                        ]);
                    }
                }
                else{
                    return $this->render('create', [
                        'model' => $model,
                        'kategori_surat'=> $kat,
                        'sekolah'=> $sek,
                        'beban_kerja_kepada'=> $stf,
                    ]);
                }

            } else {

                return $this->render('create', [
                    'model' => $model,
                    'kategori_surat'=> $kat,
                    'sekolah'=> $sek,
                    'beban_kerja_kepada'=> $stf,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }
    }

    /**
     * Updates an existing StafSuratMasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('app/administrator/surat_masuk/update')){
            $model = $this->findModel($id);
            $kategori_surat= StafKategoriSurat::find()->all();
            if($kategori_surat==NULL){
                $kat=[NULL=>'belum ada kategori diinputkan'];
            }
            else{
                foreach ($kategori_surat as $key=> $item){
                    $kat[$item->uid_kategori_surat]=$item->nama_kategori;
                }
            }

            $sekolah= DmSekolah::find()->all();
            if($sekolah==NULL){
                $sek=[NULL=>'belum ada sekolah diinputkan'];
            }
            else{
                foreach ($sekolah as $key=> $item){
                    $sek[$item->uid_dm_sekolah]=$item->nama;
                }
            }

            $staf= Staf::find()->all();
            if($staf==NULL){
                $stf=[NULL=>'belum ada sekolah diinputkan'];
            }
            else{
                foreach ($staf as $key=> $item){
                    $stf[$item->uid_staf]=$item->nama;
                }
            }

            if ($model->load(Yii::$app->request->post())) {

                if((@$_POST['check_helper'])==0){
                    $model->beban_kerja_kepada=NULL;
                    $model->tindakan_yang_harus_dilakukan='';
                }
                else{
                    //get uid staf
                    $stafuids= Staf::findOne(['hak_akses'=>Yii::$app->user->identity->getId()]);
                    $stafuid= StafSuratMasuk::findOne($id);
                    $model->beban_kerja_kepada= $model->beban_kerja_kepada==NULL||$model->beban_kerja_kepada==''?($stafuid->beban_kerja_kepada!=''||$stafuid->beban_kerja_kepada!=NULL?$stafuid->beban_kerja_kepada:$stafuids->uid_staf):$model->beban_kerja_kepada;
                }

                if($model->validate()){

                    if($model->document_scan=UploadedFile::getInstance($model, 'document_scan')){
                        $tempPath = $model->document_scan->tempName;
                        $type= $model->document_scan->type;
                        $folder= Yii::$app->params['googleDrive']['folder']['general'];
                        $uploadGDrive= new GDriveSetting();
                        $id_gdrive= $uploadGDrive->uploadGDrive($id, $tempPath, $type, $folder, 'public');
                        $model->id_google_drive= $id_gdrive;
                    }

                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->uid_surat_masuk]);
                    }
                    else{
                        return $this->render('update', [
                            'model' => $model,
                            'kategori_surat'=> $kat,
                            'sekolah'=> $sek,
                            'beban_kerja_kepada'=> $stf,
                        ]);
                    }
                }
                else{
                    return $this->render('update', [
                        'model' => $model,
                        'kategori_surat'=> $kat,
                        'sekolah'=> $sek,
                        'beban_kerja_kepada'=> $stf,
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'kategori_surat'=> $kat,
                    'sekolah'=> $sek,
                    'beban_kerja_kepada'=> $stf,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    /**
     * Deletes an existing StafSuratMasuk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(\Yii::$app->user->can('app/administrator/surat_masuk/delete')){
            $id=@$_POST['id'];
            if($this->findModel($id)->delete()){
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            echo -1;
        }

    }

    public function actionGet_staf_json(){
        if(\Yii::$app->user->can('app/administrator/surat_masuk/create')||\Yii::$app->user->can('app/administrator/surat_masuk/update')) {
            $key = @$_POST['q'];
            $staf = Staf::find()->Where([
                'or',
                ['like', 'nama', $key],
                ['like', 'nip', $key],
            ])->all();

            if ($staf != NULL) {
                foreach ($staf as $key => $item) {
                    $stf[] = ['uid_staf' => $item->uid_staf, 'nama_staf' => $item->nama, 'nip_staf' => $item->nip];
                }
            } else {
                $stf[0] = ['uid_staf' => '', 'nama_staf' => '-- not found --', 'nip_staf' => 'no data for return (jika dipilih, beban tugas diberikan kepada anda)'];
            }

            print_r(json_encode($stf));

        }
        else{
            echo -1;
        }

    }

    public function actionGet_data_staf_json(){
        $item= Staf::findOne(@$_POST['id']);
        if($item){
            $stf[] = ['uid_staf' => $item->uid_staf, 'nama_staf' => $item->nama, 'nip_staf' => $item->nip];
        }
        else{
            $stf[]='';
        }

        echo json_encode($stf);
    }

    public  function actionGet_document(){
        $gdrive= new GDriveSetting();
        echo $gdrive->readGDriveOne(@$_POST['id']);
    }

    public function uidGenerator(){
        return $uid=uniqid('srt_msk_');
    }


    /**
     * Finds the StafSuratMasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StafSuratMasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StafSuratMasuk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
