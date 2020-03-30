<?php

namespace app\modules\administrator\controllers;

use Yii;
use app\modules\administrator\models\general\TahunAjaran;
use app\modules\administrator\models\search\TahunAjaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Tahun_ajaranController implements the CRUD actions for TahunAjaran model.
 */
class Tahun_ajaranController extends Controller
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
     * Lists all TahunAjaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TahunAjaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TahunAjaran model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        if(\Yii::$app->user->can('superUser')){
            $attributes=[
                'uid_thn_ajaran',
                'kode_tahun_ajaran',
                'nama',
                'tanggal_mulai',
                'tanggal_selesai',
                [
                    'attribute'=>'status',
                    'format'=>'raw',
                    'value'=>$model->status==1?'<span class="label bg-blue">Aktif</span>':'<span class="label bg-pink">Tidak Aktif</span>',
                ],
                'create_by',
                'create_at',
                'update_at'];
        }
        else{
            $attributes=[
                'kode_tahun_ajaran',
                'nama',
                'tanggal_mulai',
                'tanggal_selesai',
                [
                    'attribute'=>'status',
                    'format'=>'raw',
                    'value'=>$model->status==1?'<span class="label bg-blue">Aktif</span>':'<span class="label bg-pink">Tidak Aktif</span>',
                ]
            ];
        }
        return $this->render('view', [
            'model' => $model,
            'attributes'=> $attributes,
        ]);
    }

    /**
     * Creates a new TahunAjaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TahunAjaran();

        if ($model->load(Yii::$app->request->post())) {
            $model->uid_thn_ajaran=$this->uidGenerator();
            $model->create_by= Yii::$app->user->identity->getId();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->uid_thn_ajaran]);
            }
            else{
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
     * Updates an existing TahunAjaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid_thn_ajaran]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TahunAjaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        $id= $_POST['id'];
        if($this->findModel($id)->delete()){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function uidGenerator(){
        return $uid=uniqid('thn_ajr_');
    }

    /**
     * Finds the TahunAjaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TahunAjaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TahunAjaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
