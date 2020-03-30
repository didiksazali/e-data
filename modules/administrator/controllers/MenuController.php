<?php

namespace app\modules\administrator\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `administrator` module
 */
class MenuController extends Controller
{
    public $layout='material_adv';

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
     * Renders the index view for the module
     * @return string
     */
    public function actionAtur_menu()
    {
        if (\Yii::$app->user->can('aturMenu')) {
            return $this->render('index');
        }
        else{
            return $this->renderPartial('/default/cant_access');
        }
    }
}
