<?php

namespace app\modules\administrator\controllers;

use Yii;
use app\modules\administrator\models\general\DmSekolah;
use app\modules\administrator\models\search\DmSekolahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DataSekolahController implements the CRUD actions for DmSekolah model.
 */
class Data_sekolahController extends Controller
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
     * Lists all DmSekolah models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DmSekolahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DmSekolah model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model= $this->findModel($id);
        if(\Yii::$app->user->can('superUser')){
            $attributes=[
                'uid_dm_sekolah',
                'npsn',
                'nss_nsm',
                [
                    'attribute'=> 'jenjang_sekolah',
                    'format'=> 'raw',
                    'value'=>'<span class="label bg-blue">'.$model->jenjang_sekolah.'</span>',
                ],
                'nama',
                'alamat',
                'kode_pos',
                'status',
                'akreditas',
                'no_telp',
                'fax',
                'email:email',
                [
                    'attribute'=> 'tagline',
                    'format'=> 'raw',
                    'value'=>$model->tagline==''?'-':$model->tagline,
                ],
                [
                    'attribute'=> 'visi',
                    'format'=> 'raw',
                    'value'=>$model->visi==''?'-':$model->visi,
                ],
                [
                    'attribute'=> 'misi',
                    'format'=> 'raw',
                    'value'=>$model->misi==''?'-':$model->misi,
                ],
                [
                    'attribute'=> 'create_by',
                    'format'=> 'raw',
                    'value'=>$model->createBy->username,
                ],
                'create_at',
                'update_at',
            ];
        }
        else{
            $attributes=[
                'npsn',
                'nss_nsm',
                [
                    'attribute'=> 'jenjang_sekolah',
                    'format'=> 'raw',
                    'value'=>'<span class="label bg-blue">'.$model->jenjang_sekolah.'</span>',
                ],
                'nama',
                'alamat',
                'kode_pos',
                'status',
                'akreditas',
                'no_telp',
                'fax',
                'email:email',
                [
                    'attribute'=> 'tagline',
                    'format'=> 'raw',
                    'value'=>$model->tagline==''?'-':$model->tagline,
                ],
                [
                    'attribute'=> 'visi',
                    'format'=> 'raw',
                    'value'=>$model->visi==''?'-':$model->visi,
                ],
                [
                    'attribute'=> 'misi',
                    'format'=> 'raw',
                    'value'=>$model->visi==''?'-':$model->misi,
                ],
            ];
        }
        return $this->render('view', [
            'model' => $model,
            'attributes'=> $attributes,
        ]);
    }

    /**
     * Creates a new DmSekolah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DmSekolah();
        $model->scenario='create';

        if ($model->load(Yii::$app->request->post())) {
            $model->logo_helper=UploadedFile::getInstance($model, 'logo_helper');
            $uid = $this->uidGenerator();
            $model->create_by= \Yii::$app->user->getId();
            $model->uid_dm_sekolah= $uid;
            $model->logo= $uid;
            if($model->validate()){
                $model->logo= 'img/logo/'.$model->npsn.'.'.$model->logo_helper->extension;
                if($model->save()){
                    $model->logo_helper->saveAs($model->logo);
                    return $this->redirect(['view', 'id' => $model->uid_dm_sekolah]);
                }
                else{
                    print_r($model->getErrors());
                    exit();
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
            else{
                print_r($model->getErrors());
                exit();
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DmSekolah model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $helper= 0;
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                if($model->logo_helper=UploadedFile::getInstance($model, 'logo_helper')){
                    $helper=1;
                    $model->logo= 'img/logo/'.$model->npsn.'.'.$model->logo_helper->extension;
                }
                if($model->save()){
                    if($helper==1){
                        $model->logo_helper->saveAs($model->logo);
                    }
                    return $this->redirect(['view', 'id' => $model->uid_dm_sekolah]);
                }
                else{
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
            else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DmSekolah model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(\Yii::$app->user->can('app/administrator/data_sekolah/delete')){
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

    public function uidGenerator(){
        return $uid=uniqid('sekolah_');
    }

    /**
     * Finds the DmSekolah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DmSekolah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DmSekolah::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
