<?php

namespace app\modules\administrator\controllers;

use Yii;
use app\modules\administrator\models\general\DmJabatan;
use app\modules\administrator\models\search\DmJabatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataJabatanController implements the CRUD actions for DmJabatan model.
 */
class Data_jabatanController extends Controller
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
     * Lists all DmJabatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DmJabatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DmJabatan model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model= $this->findModel($id);
        if(\Yii::$app->user->can('superUser')){
            $attributes=[
                            [
                                'attribute'=> 'kode_jabatan',
                                'format'=> 'raw',
                                'value'=>'<span class="label bg-blue">'.$model->kode_jabatan.'</span>',
                            ],
                            'nama_jabatan',
                            'deskripsi_jabatan',
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
                        [
                            'attribute'=> 'kode_jabatan',
                            'format'=> 'raw',
                            'value'=>'<span class="label bg-blue">'.$model->kode_jabatan.'</span>',
                        ],
                            'nama_jabatan',
                            'deskripsi_jabatan',
                        ];
        }

        return $this->render('view', [
            'model' => $model,
            'attributes'=>  $attributes,
        ]);
    }

    /**
     * Creates a new DmJabatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DmJabatan();

        if ($model->load(Yii::$app->request->post())) {
            $model->kode_jabatan= str_replace(' ', '.', $model->kode_jabatan);
            $model->create_by= \Yii::$app->user->getId();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_jabatan]);
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
     * Updates an existing DmJabatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_jabatan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DmJabatan model.
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
    }

    /**
     * Finds the DmJabatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DmJabatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DmJabatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
