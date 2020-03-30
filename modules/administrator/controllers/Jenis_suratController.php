<?php

namespace app\modules\administrator\controllers;

use app\modules\administrator\models\general\DmSekolah;
use app\modules\administrator\models\general\StafTemplateSurat;
use Yii;
use app\modules\administrator\models\general\StafJenisSurat;
use app\modules\administrator\models\search\StafJenisSuratSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Jenis_suratController implements the CRUD actions for StafJenisSurat model.
 */
class Jenis_suratController extends Controller
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
     * Lists all StafJenisSurat models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('app/administrator/jenis_surat/index')){
            $searchModel = new StafJenisSuratSearch();
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

    /**
     * Displays a single StafJenisSurat model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('app/administrator/jenis_surat/view')){
            $model=$this->findModel($id);
            if(\Yii::$app->user->can('superUser')){
                $attributes=[
                    'uid_jenis_surat',
                    'nama_jenis_surat',
                    [
                        'attribute'=>'uid_template_surat',
                        'value'=>$model->uidTemplateSurat->nama_template,
                    ],
                    [
                        'attribute'=>'estimasi_selesai',
                        'value'=>$model->estimasi_selesai.' Hari',
                    ],

                    [
                        'attribute'=>'biaya',
                        'value'=>'Rp. '.$model->biaya,
                    ],
                    'no_surat',
                    //'default_attribute_tambahan:ntext',
                    [
                        'attribute'=>'status',
                        'value'=>$model->status==1?'Aktif':'Tidak Aktif',
                    ],
                    [
                        'attribute'=>'create_by',
                        'value'=>$model->createBy->username,
                    ],
                    'create_at',
                    'update_by',
                ];
            }
            else{
                $attributes=[
                    'nama_jenis_surat',
                    [
                        'attribute'=>'uid_template_surat',
                        'value'=>$model->uidTemplateSurat->nama_template,
                    ],
                    [
                        'attribute'=>'estimasi_selesai',
                        'value'=>$model->estimasi_selesai.' Hari',
                    ],
                    [
                        'attribute'=>'biaya',
                        'value'=>'Rp. '.$model->biaya,
                    ],
                    'no_surat',
                    //'default_attribute_tambahan:ntext',
                    [
                        'attribute'=>'status',
                        'value'=>$model->status==1?'Aktif':'Tidak Aktif',
                    ]
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
     * Creates a new StafJenisSurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('app/administrator/jenis_surat/create')){
            $model = new StafJenisSurat();
            $sekolah= DmSekolah ::find()->all();
            if($sekolah==NULL){
                $sek=[NULL=>'belum ada sekolah diinputkan'];
            }
            else{
                foreach ($sekolah as $key=> $item){
                    $sek[$item->uid_dm_sekolah]=$item->nama;
                }
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->uid_jenis_surat= $this->uidGenerator();
                $model->create_by= Yii::$app->user->identity->getId();
                $model->status= @$_POST['status'];
                $model->default_attribute_tambahan='';

                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->uid_jenis_surat]);
                }
                else{
                    return $this->render('create', [
                        'model' => $model,
                        'help_sekolah'=> $sek,
                    ]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'help_sekolah'=> $sek,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }
    }

    /**
     * Updates an existing StafJenisSurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('app/administrator/jenis_surat/update')){
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

            //get sekolah
            $model->help_sekolah= $model->uidTemplateSurat->uidUntukSekolah->uid_dm_sekolah;
            //get template from uid sekolah
            $template_surat= StafTemplateSurat::find()->where(['staf_template_surat.uid_untuk_sekolah'=>$model->uidTemplateSurat->uidUntukSekolah->uid_dm_sekolah,'status'=>1])->all();
            if($template_surat==NULL){
                $temp=[NULL=>'belum ada template diinputkan'];
            }
            else{
                foreach ($template_surat as $key=> $item){
                    $temp[$item->uid_template_surat]=$item->nama_template;
                }
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->status= @$_POST['status'];
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->uid_jenis_surat]);
                }
            } else {


                return $this->render('update', [
                    'model' => $model,
                    'help_sekolah'=> $sek,
                    'help_template_surat'=> $temp,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    /**
     * Deletes an existing StafJenisSurat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(\Yii::$app->user->can('app/administrator/jenis_surat/delete')){
            if($this->findModel(@$_POST['id'])->delete()){
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

    public function actionGet_template(){
        if(\Yii::$app->user->can('app/administrator/jenis_surat/create')||\Yii::$app->user->can('app/administrator/jenis_surat/update')){
            $template= StafTemplateSurat::find()->where(['uid_untuk_sekolah'=>@$_POST['id'],'status'=>1])->all();
            echo '<select id="stafjenissurat-uid_template_surat" class="form-control show-tick" data-live-search="true" name="StafJenisSurat[uid_template_surat]" >';
                echo '<option value=NULL>PILIH SATU</option>';
                foreach ($template as $key=> $item){
                    echo '<option value="'.$item->uid_template_surat.'">'.$item->nama_template.'</option>';
                }
            echo "</select>";
        }
        else{
            echo "you have not access here, sorry guys...";
        }
    }

    public function uidGenerator(){
        return $uid=uniqid('jns_srt_');
    }

    /**
     * Finds the StafJenisSurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StafJenisSurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StafJenisSurat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
