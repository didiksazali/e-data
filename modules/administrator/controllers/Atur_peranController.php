<?php

namespace app\modules\administrator\controllers;

use app\modules\administrator\models\general\AuthItem;
use Yii;
use app\modules\administrator\models\AuthAssignment;
use app\modules\administrator\models\AssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Atur_peranController implements the CRUD actions for AuthAssignment model.
 */
class Atur_peranController extends Controller
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

    public function actionAtur()
    {

        return $this->render('atur_peran', ['item'=>$this->getItem()]);
    }

    public function getItem(){
        //get from item
        $item= AuthItem::find()->where(['not',['type'=>1]])->all();
        if($item!=NULL){
            foreach ($item as $key=> $value){
                if($value->type==2) {
                    //jika type 2
                    $module[] = ['id' => $value->id, 'parrent_id'=>$value->parrent_id, 'router' => $value->name, 'deskripsi' => $value->description, 'rule_name' => $value->rule_name];
                }
                else if($value->type==3){
                    $controller[] = ['id' => $value->id, 'parrent_id'=>$value->parrent_id, 'router' => $value->name, 'deskripsi' => $value->description, 'rule_name' => $value->rule_name];
                }
                else{
                    $action[] = ['id' => $value->id, 'parrent_id'=>$value->parrent_id, 'router' => $value->name, 'deskripsi' => $value->description, 'rule_name' => $value->rule_name];
                }
            }
            foreach ($module as $key=> $value){
                foreach ($controller as $keys=> $values){
                    if($values['parrent_id']==$value['id']){
                        $module[$key]['child'][]= $values;
                        foreach ($action as $keyz=> $valuez){
                            if($valuez['parrent_id']==$values['id']){
                                $module[$key]['child'][$keys]['child'][]= $valuez;
                            }
                        }
                    }
                }
            }
        }
        else{
            $module=[NULL];
        }
        return $module;
    }

    /**
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthAssignment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionDelete($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
