<?php

namespace app\modules\administrator\controllers;

use Yii;
use app\modules\administrator\models\general\StafKategoriSurat;
use app\modules\administrator\models\search\StafKategoriSuratSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Kategori_suratController implements the CRUD actions for StafKategoriSurat model.
 */
class Kategori_suratController extends Controller
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
     * Lists all StafKategoriSurat models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('app/administrator/kategori_surat/index')){
            $searchModel = new StafKategoriSuratSearch();
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
     * Displays a single StafKategoriSurat model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('app/administrator/kategori_surat/view')){
            $model= $this->findModel($id);
            if(\Yii::$app->user->can('superUser')){
                $attributes= [
                    'uid_kategori_surat',
                    'nama_kategori',
                    'dekripsi',
                    'create_by',
                    'create_at',
                    'update_at',
                ];
                //lengkapnya taruh disini
            }
            else{
                $attributes= [
                    'nama_kategori',
                    'dekripsi',
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
     * Creates a new StafKategoriSurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('app/administrator/kategori_surat/create')){
            $model = new StafKategoriSurat();

            if ($model->load(Yii::$app->request->post())) {
                $model->uid_kategori_surat= $this->uidGenerator();
                $model->create_by= Yii::$app->user->identity->getId();
                if($model->save()){
                    Yii::$app->session->setFlash('create_success', "Data staf dengan nama ".$model->nama_kategori." berhasil disimpan");
                    return $this->redirect(['view', 'id' => $model->uid_kategori_surat]);
                }
                else{
                    Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");
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
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    /**
     * Updates an existing StafKategoriSurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('app/administrator/kategori_surat/update')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                if($model->save()){
                    Yii::$app->session->setFlash('create_success', "Data staf dengan nama ".$model->nama_kategori." berhasil dirubah");
                    return $this->redirect(['view', 'id' => $model->uid_kategori_surat]);
                }
                else{
                    Yii::$app->session->setFlash('create_unsuccess', "Maaf ada kesalahan, silahkan cek ulang semua data yang diinput dan ulangi lagi");
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
        else{
            return $this->renderPartial('/default/cant_access');
        }

    }

    /**
     * Deletes an existing StafKategoriSurat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(\Yii::$app->user->can('app/administrator/kategori_surat/delete')){
            $id= @$_POST['id'];
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
        return $uid=uniqid('ktg_srt_');
    }

    /**
     * Finds the StafKategoriSurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StafKategoriSurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StafKategoriSurat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
