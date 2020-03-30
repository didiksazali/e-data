<?php

namespace app\modules\administrator\controllers;

use Yii;
use app\modules\administrator\models\Aturan;
use app\modules\administrator\models\AturanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AturanController implements the CRUD actions for Aturan model.
 */
class AturanController extends Controller
{
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
     * Lists all Aturan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('testRBAC')) {
            echo "BISA AKSES";
        }
        else{
          return $this->renderPartial('/default/cant_access');
        }
    }


}
