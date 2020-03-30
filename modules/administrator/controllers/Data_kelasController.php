<?php

namespace app\modules\administrator\controllers;

use app\modules\administrator\models\general\DmSekolah;
use Yii;
use app\modules\administrator\models\general\Kelas;
use app\modules\administrator\models\search\KelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Data_kelasController implements the CRUD actions for Kelas model.
 */
class Data_kelasController extends Controller
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
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kelas model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model= $this->findModel($id);
        if(\Yii::$app->user->can('superUser')){
            $attributes=[
                'uid_kelas',
                [
                    'attribute'=> 'uid_sekolah',
                    'format'=>'raw',
                    'value'=>$model->uidSekolah->nama,
                ],
                'kode_kelas',
                'nama_kelas',
                'ruangan_kelas',
                [
                    'attribute'=> 'uid_sekolah',
                    'format'=>'raw',
                    'value'=>$model->createBy->username,
                ],
                'create_at',
                'update_at'
            ];
        }
        else{
            $attributes=[
                [
                    'attribute'=> 'uid_sekolah',
                    'format'=>'raw',
                    'value'=>$model->uidSekolah->nama,
                ],
                'kode_kelas',
                'nama_kelas',
                'ruangan_kelas',
            ];
        }


        return $this->render('view', [
            'model' => $model,
            'attributes'=> $attributes,
        ]);
    }

    /**
     * Creates a new Kelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kelas();
        $sekolah= DmSekolah::find()->all();
        if ($sekolah!=NULL){
            foreach ($sekolah as $key=>$item) {
                $sek[$item->uid_dm_sekolah]= $item->nama;
            }
        }
        else{
            $sek[NULL]='--tidak ada sekolah di input--';
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->create_by= \Yii::$app->user->getId();
            $model->uid_kelas= $this->uidGenerator();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->uid_kelas]);
            }
            else{
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

    /**
     * Updates an existing Kelas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sekolah= DmSekolah::find()->all();
        if ($sekolah!=NULL){
            foreach ($sekolah as $key=>$item) {
                $sek[$item->uid_dm_sekolah]= $item->nama;
            }
        }
        else{
            $sek[NULL]='--tidak ada sekolah di input--';
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid_kelas]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'sekolah'=> $sek,
            ]);
        }
    }

    /**
     * Deletes an existing Kelas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(\Yii::$app->user->can('app/administrator/data_kelas/delete')){
            $id= $_POST['id'];
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
        return $uid=uniqid('kls');
    }

    /**
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
