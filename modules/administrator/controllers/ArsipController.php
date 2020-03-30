<?php

namespace app\modules\administrator\controllers;

use Yii;
use app\modules\administrator\models\general\StafSuratMasuk;
use app\modules\administrator\models\general\StafBuatMasuk;
use app\modules\administrator\models\search\StafSuratMasukSearch;
use app\modules\administrator\models\search\StafBuatSuratSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Data_kelas_listController implements the CRUD actions for Kelas model.
 */
class ArsipController extends Controller
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
        $searchModelSuratMasuk = new StafSuratMasukSearch();
        $dataProviderSuratMasuk = $searchModelSuratMasuk->search2(Yii::$app->request->queryParams);
        $dataProviderSuratMasuk->pagination->pageSize=1;
        /////////////////////////////////////////////////
        $searchModelSuratKeluar = new StafBuatSuratSearch();
        $dataProviderSuratKeluar = $searchModelSuratKeluar->search2(Yii::$app->request->queryParams);
        $dataProviderSuratKeluar->pagination->pageSize=1;

        return $this->render('index', [
            'searchModelSuratMasuk' => $searchModelSuratMasuk,
            'dataProviderSuratMasuk' => $dataProviderSuratMasuk,
            'searchModelSuratKeluar' => $searchModelSuratKeluar,
            'dataProviderSuratKeluar' => $dataProviderSuratKeluar,
        ]);
    }


}
