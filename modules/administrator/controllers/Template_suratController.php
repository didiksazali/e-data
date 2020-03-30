<?php

namespace app\modules\administrator\controllers;

use app\modules\administrator\models\general\DmSekolah;
use Yii;
use app\modules\administrator\models\general\StafTemplateSurat;
use app\modules\administrator\models\search\StafTemplateSuratSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Template_suratController implements the CRUD actions for StafTemplateSurat model.
 */
class Template_suratController extends Controller
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
     * Lists all StafTemplateSurat models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('app/administrator/template_surat/index')){
            $searchModel = new StafTemplateSuratSearch();
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
     * Displays a single StafTemplateSurat model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('app/administrator/template_surat/view')){
            $model= $this->findModel($id);

            if(\Yii::$app->user->can('superUser')){

                    $attributes=[
                                    'uid_template_surat',
                                    'nama_template',
                                    'deskripsi_template:ntext',
                                    'path_template',
                                    [
                                        'attribute'=>'status',
                                        'value'=>$model->status==1?'Aktif':'Tidak Aktif',
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
                    $attributes=[
                                    'nama_template',
                                    'deskripsi_template:ntext',
                                    [
                                        'attribute'=>'status',
                                        'value'=>$model->status==1?'Aktif':'Tidak Aktif',
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
     * Creates a new StafTemplateSurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('app/administrator/template_surat/create')){
            $model = new StafTemplateSurat();
            $model->scenario='create';
            //get list sekolah

            $sekolah= DmSekolah::find()->all();
            if($sekolah==NULL){
                $sek=[NULL=>'belum ada sekolah diinputkan'];
            }
            else{
                foreach ($sekolah as $key=> $item){
                    $sek[$item->uid_dm_sekolah]=$item->nama;
                }
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->document = UploadedFile::getInstance($model, 'document');
                $uid=$this->uidGenerator();
                $model->uid_template_surat= $uid;
                $model->status= @$_POST['status'];
                $model->create_by= Yii::$app->user->identity->getId();
                $model->path_template= $uid;
                $model->path_template ='document/template-surat/'.$model->uid_template_surat.'.'.$model->document->extension;
                    if($model->save()){
                        $model->document->saveAs($model->path_template);
                        return $this->redirect(['view', 'id' => $model->uid_template_surat]);
                    }
                    else{
                        print_r($model->getErrors());
                        exit();
                        return $this->render('create', [
                            'model' => $model,
                            'sekolah'=> $sek,
                        ]);
                    }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'sekolah'=> $sek,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    /**
     * Updates an existing StafTemplateSurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('app/administrator/template_surat/update')){
            $model = $this->findModel($id);
            $helper = 0;
            //get sekolah
            $sekolah= DmSekolah::find()->all();
            if($sekolah==NULL){
                $sek=[NULL=>'belum ada sekolah diinputkan'];
            }
            else{
                foreach ($sekolah as $key=> $item){
                    $sek[$item->uid_dm_sekolah]=$item->nama;
                }
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->status= @$_POST['status'];
                if($model->validate()){
                    if($model->document = UploadedFile::getInstance($model, 'document')){
                        $model->path_template ='document/template-surat/'.$model->uid_template_surat.'.'.$model->document->extension;
                        $helper= 1;
                    }
                    if($model->save()){
                        if($helper==1){
                            $model->document->saveAs($model->path_template);
                        }
                        return $this->redirect(['view', 'id' => $model->uid_template_surat]);
                    }
                    else{
                        return $this->render('update', [
                            'model' => $model,
                            'sekolah'=> $sek,
                        ]);
                    }
                }
                else{
                    return $this->render('update', [
                        'model' => $model,
                        'sekolah'=> $sek,
                    ]);
                }

            } else {
                return $this->render('update', [
                    'model' => $model,
                    'sekolah'=> $sek,
                ]);
            }
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    /**
     * Deletes an existing StafTemplateSurat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(\Yii::$app->user->can('app/administrator/template_surat/delete')){
            if($this->findModel($_POST['id'])->delete()){
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

    public function uidGenerator(){
        return $uid=uniqid('tmp_srt_');
    }

    /**
     * Finds the StafTemplateSurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StafTemplateSurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StafTemplateSurat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
