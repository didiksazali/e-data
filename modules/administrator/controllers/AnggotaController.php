<?php

namespace app\modules\administrator\controllers;

use Yii;
use app\modules\administrator\models\general\Anggota;
use app\modules\administrator\models\general\Pendidikan;
use app\modules\administrator\models\general\Penghasilan;
use app\modules\administrator\models\search\AnggotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AnggotaController implements the CRUD actions for Anggota model.
 */
class AnggotaController extends Controller
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
     * Lists all Anggota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anggota model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Anggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anggota();
        $pendidikan= Pendidikan::find()->all();

        if($pendidikan==NULL){
            $pendidikans=[NULL=>'belum ada pendidikan diinputkan'];
        }
        else{
            foreach ($pendidikan as $key=> $item){
                $pendidikans[$item->id_pendidikan]=$item->nama_pendidikan;
            }
        }

        $penghasilan= Penghasilan::find()->all();

        if($penghasilan==NULL){
            $penghasilans=[NULL=>'belum ada penghasilan diinputkan'];
        }
        else{
            foreach ($penghasilan as $key=> $item){
                $penghasilans[$item->id_penghasilan]=$item->nama_penghasilan;
            }
        }



        if ($model->load(Yii::$app->request->post())) {
            $model->fotoHelper = UploadedFile::getInstance($model,'fotoHelper');

            $pathFoto = 'upload/foto/' . $model->fotoHelper->baseName . '.' . $model->fotoHelper->extension;
            $model->foto = $pathFoto;

            $model->kkHelper = UploadedFile::getInstance($model,'kkHelper');
            $pathKk = 'upload/kk/' . $model->kkHelper->baseName . '.' . $model->kkHelper->extension;
            $model->kk = $pathKk;

            // print_r($model->foto);
            // exit();
             if($model->save()){
               $model->kkHelper->saveAs($pathKk);
               $model->fotoHelper->saveAs($pathFoto);
               return $this->redirect(['view', 'id' => $model->id_anggota]);
             }
             else {
               print_r($model->getErrors());
             }


        } else {

            return $this->render('create', [
                'model' => $model,
                'pendidikan' => $pendidikans,
                'penghasilan' => $penghasilans,
            ]);
        }


        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_anggota]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //         'pendidikan' => $pendidikans,
        //         'penghasilan' => $penghasilans,
        //     ]);
        // }



    }

    /**
     * Updates an existing Anggota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pendidikan= Pendidikan::find()->all();

        if($pendidikan==NULL){
            $pendidikans=[NULL=>'belum ada pendidikan diinputkan'];
        }
        else{
            foreach ($pendidikan as $key=> $item){
                $pendidikans[$item->id_pendidikan]=$item->nama_pendidikan;
            }
        }

        $penghasilan= Penghasilan::find()->all();

        if($penghasilan==NULL){
            $penghasilans=[NULL=>'belum ada penghasilan diinputkan'];
        }
        else{
            foreach ($penghasilan as $key=> $item){
                $penghasilans[$item->id_penghasilan]=$item->nama_penghasilan;
            }
        }


        if ($model->load(Yii::$app->request->post())) {
          $fotoX = 0;
          if ( UploadedFile::getInstance($model,'fotoHelper')) {
          $fotoX = 1;
          $model->fotoHelper = UploadedFile::getInstance($model,'fotoHelper');

          $pathFoto = 'upload/foto/' . $model->fotoHelper->baseName . '.' . $model->fotoHelper->extension;
          $model->foto = $pathFoto;
          }
          $kkY = 0;
          if (UploadedFile::getInstance($model,'kkHelper')) {
            $model->kkHelper = UploadedFile::getInstance($model,'kkHelper');
            $pathKk = 'upload/kk/' . $model->kkHelper->baseName . '.' . $model->kkHelper->extension;
            $model->kk = $pathKk;
          }


        if ($model->save()) {
          if ($fotoX==1) {

            $model->fotoHelper->saveAs($pathFoto);
          }
          if ($kkY==1) {
              $model->kkHelper->saveAs($pathKk);
          }
        }


            return $this->redirect(['view', 'id' => $model->id_anggota]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'pendidikan' => $pendidikans,
                'penghasilan' => $penghasilans,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_anggota]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing Anggota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Anggota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anggota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anggota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
