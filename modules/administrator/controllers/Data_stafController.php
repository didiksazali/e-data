<?php

namespace app\modules\administrator\controllers;

use app\gdrive\GDriveSetting;
use app\modules\administrator\models\general\DmJabatan;
use app\modules\administrator\models\general\User;
use Yii;
use app\modules\administrator\models\general\Staf;
use app\modules\administrator\models\search\StafSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Data_stafController implements the CRUD actions for Staf model.
 */
class Data_stafController extends Controller
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
     * Lists all Staf models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('app/administrator/data_staf/index')) {
            $searchModel = new StafSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->renderPartial('/default/cant_access');
        }
    }

    /**
     * Displays a single Staf model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('app/administrator/data_staf/view')){
                $model=$this->findModel($id);
                if(\Yii::$app->user->can('superUser')){
                    $attributes= [
                        'uid_staf',
                        'nip',
                        'nama',
                        [
                            'attribute'=>'jenis_kelamin',
                            'value'=>$model->jenis_kelamin==1? 'Laki-laki': 'Perempuan',
                        ],
                        'alamat',
                        'status_kepegawaian',
                        [
                            'attribute'=>'status_keluarga',
                            'value'=>$model->jenis_kelamin==1? 'Sudah Menikah': 'Belum Menikah',
                        ],
                        [
                            'attribute'=>'jabatan',
                            'value'=>$model->jabatanStaf->nama_jabatan,
                        ],
                        [
                            'label'=>'Email',
                            'value'=>$model->user->email,
                        ],

                        'create_by',
                        'create_at',
                        'update_at',
                        //atribut lengkap disini
                    ];
                }
                else{
                    $attributes= [
                        'nip',
                        'nama',
                        [
                            'attribute'=>'jenis_kelamin',
                            'value'=>$model->jenis_kelamin==1? 'Laki-laki': 'Perempuan',
                        ],
                        'alamat',
                        'status_kepegawaian',
                        [
                            'attribute'=>'status_keluarga',
                            'value'=>$model->jenis_kelamin==1? 'Sudah Menikah': 'Belum Menikah',
                        ],
                        [
                            'attribute'=>'jabatan',
                            'value'=>$model->jabatanStaf->nama_jabatan,
                        ],
                        [
                            'label'=>'Email',
                            'value'=>$model->user->email,
                        ],
                    ];
                }

            return $this->render('view', [
                'model' => $model,
                'attributes'=> $attributes,
            ]);
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }
    }

    /**
     * Creates a new Staf model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (\Yii::$app->user->can('app/administrator/data_staf/create')) {

            $model_staf = new Staf();
            $model_user  = new User();
            $model_staf->scenario = 'create';
            $uploadGDrive= new GDriveSetting();

            //getjabatan
            $jabatan= DmJabatan::find()->all();
            foreach($jabatan as $key=> $item){
                $jab[$item->kode_jabatan]= $item->nama_jabatan;
            }

            if ($model_staf->load(Yii::$app->request->post())&&$model_user->load(Yii::$app->request->post())) {

                $uid = $this->uidGenerator();
                $foto=0;
                if(UploadedFile::getInstance($model_staf, 'foto')){
                    $model_staf->foto=UploadedFile::getInstance($model_staf, 'foto');
                    $tempPath = $model_staf->foto->tempName;
                    $type= $model_staf->foto->type;
                    $folder= Yii::$app->params['googleDrive']['folder']['general'];
                    $foto=1;
                }
                else{

                }
                //for model staf
                $help= rand(1, 99999); // helper
                $model_staf->uid_staf= $uid;
                $model_staf->jenis_kelamin= $_POST['jenis_kelamin'];
                $model_staf->status_keluarga= $_POST['status_keluarga'];
                $model_staf->gdrive_pasfoto_staf='';
                $model_staf->hak_akses= $help;
                $model_staf->create_by= Yii::$app->user->identity->getId();
                //for model user/ hak akses;
                $model_user->username= $model_staf->nip;
                $model_user->password_hash= Yii::$app->security->generatePasswordHash($model_staf->password);
                $model_user->status=10;
                $model_user->password_reset_token='';

                if($model_staf->validate() && $model_user->validate()){
                    if($foto!=0){
                        $id= $uploadGDrive->uploadGDrive($uid, $tempPath, $type, $folder, 'public');
                        $model_staf->gdrive_pasfoto_staf=$id;
                    }

                    if($model_user->save()){
                        $tmp= $model_user->id;
                        $model_staf->hak_akses= $tmp;
                        if($model_staf->save()){
                            Yii::$app->session->setFlash('create_success', "Data staf dengan nama ".$model_staf->nama." berhasil disimpan");
                            return $this->redirect(['view', 'id' => $model_staf->uid_staf]);
                        }
                        else{
                            //delete user
                            $delete_user = User::find($tmp);
                            $delete_user->delete();
                            //to show error from 2 model
                            $model_staf->validate();
                            $model_user->validate();
                            Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");
                            return $this->render('create', [
                                'model_staf' => $model_staf,
                                'model_user' => $model_user,
                                'jabatan' => $jab,
                            ]);
                        }
                    }
                    else{
                        //to show error from 2 model
                        $model_staf->validate();
                        $model_user->validate();
                        Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");
                        return $this->render('create', [
                            'model_staf' => $model_staf,
                            'model_user' => $model_user,
                            'jabatan' => $jab,
                        ]);
                    }
                }
                else{
                    //to show error from 2 model
                    $model_staf->validate();
                    $model_user->validate();
                    Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");
                    return $this->render('create', [
                        'model_staf' => $model_staf,
                        'model_user' => $model_user,
                        'jabatan' => $jab,
                    ]);
                }
            }
            else {
                return $this->render('create', [
                    'model_staf' => $model_staf,
                    'model_user' => $model_user,
                    'jabatan' => $jab,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }
    }


    /**
     * Updates an existing Staf model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //getjabatan
        $jabatan= DmJabatan::find()->all();
        foreach($jabatan as $key=> $item){
            $jab[$item->kode_jabatan]= $item->nama_jabatan;
        }

        if (\Yii::$app->user->can('app/administrator/data_staf/update')) {

            $model_staf = $this->findModel($id);
            $model_user = User::findOne($model_staf->hak_akses);

            if ($model_staf->load(Yii::$app->request->post())&&$model_user->load(Yii::$app->request->post())) {
                //jenisklmin...

                $model_staf->jenis_kelamin=$_POST['jenis_kelamin'];
                $model_staf->status_keluarga= $_POST['status_keluarga'];
                if($model_staf->validate()&&$model_user->validate()){
                    //jika update foto
                    if($model_staf->foto=UploadedFile::getInstance($model_staf, 'foto')){
                        $uploadGDrive=new GDriveSetting();
                        $tempPath = $model_staf->foto->tempName;
                        $type= $model_staf->foto->type;
                        $folder= Yii::$app->params['googleDrive']['folder']['general'];
                        $id= $uploadGDrive->uploadGDrive($model_staf->uid_staf, $tempPath, $type, $folder, 'public');
                        $model_staf->gdrive_pasfoto_staf=$id;
                    }
                    if($model_staf->save()&&$model_user->validate()){
                        $model_user->username= $model_staf->nip;

                        if($model_user->save()){
                            Yii::$app->session->setFlash('create_success', "Data staf dengan nama ".$model_staf->nama." berhasil dirubah");
                            return $this->redirect(['view', 'id' => $model_staf->uid_staf]);
                        }
                        else{
                            $model_staf->validate();
                            $model_user->validate();
                            Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");

                            return $this->render('update', [
                                'model_staf' => $model_staf,
                                'model_user' => $model_user,
                                'jabatan' => $jab,
                            ]);
                        }
                    }
                    else{
                        $model_staf->validate();
                        $model_user->validate();
                        Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");

                        return $this->render('update', [
                            'model_staf' => $model_staf,
                            'model_user' => $model_user,
                            'jabatan' => $jab,
                        ]);
                    }
                }
                else{
                    $model_staf->validate();
                    $model_user->validate();
                    Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");

                    return $this->render('update', [
                        'model_staf' => $model_staf,
                        'model_user' => $model_user,
                        'jabatan' => $jab,
                    ]);
                }

            } else {
                return $this->render('update', [
                    'model_staf' => $model_staf,
                    'model_user' => $model_user,
                    'jabatan' => $jab,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }
    }

    /**
     * Deletes an existing Staf model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if (\Yii::$app->user->can('app/administrator/data_staf/delete')) {
            $id= @$_POST['id'];
            $tmp = $this->findModel($id);
            $model_staf=new Staf();
            if ($this->findModel($id)->delete()) {
                //delete user
                $user= User::findOne($tmp->hak_akses);
                if ($user->delete()) {
                    echo 1;
                } else {
                    //simpan kembali data lama
                    foreach ($model_staf->getAttributes() as $key=> $item){
                        $model_staf->$key= $tmp[$key];
                    }
                    $model_staf->save();
                    echo 0;
                }
            } else {
                echo 0;
            }
        }
        else{
            echo -1;
        }
    }

    public  function actionGet_foto(){
        $gdrive= new GDriveSetting();
        echo $gdrive->readGDriveOne(@$_POST['id']);
    }

    public function uidGenerator(){
        return $uid=uniqid('stf_');
    }

    /**
     * Finds the Staf model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Staf the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Staf::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
