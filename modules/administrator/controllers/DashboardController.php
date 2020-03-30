<?php

namespace app\modules\administrator\controllers;

use app\modules\administrator\models\general\DmSekolah;
use app\modules\administrator\models\general\StafBuatSurat;
use app\modules\administrator\models\general\StafSuratMasuk;
use yii\filters\AccessControl;

class DashboardController extends \yii\web\Controller
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
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGet_sekolah_chart_json(){
        $sekolah= DmSekolah::find()->all();
        if($sekolah!=NULL){
            foreach ($sekolah as $key=> $sek){
                $labels[]=$sek->nama;
                $data_sm[]=StafSuratMasuk::find()->where(['tujuan_surat_kesekolah'=>$sek->uid_dm_sekolah])->count();
                $data_sk[]=StafBuatSurat::find()->joinWith('uidJenisSurat.uidTemplateSurat.uidUntukSekolah')->where(['dm_sekolah.uid_dm_sekolah'=>$sek->uid_dm_sekolah])->count();
            }

            for($a=1;$a<=2; $a++){
                if($a==1){
                    $data_label[]=['label'=>'Surat Masuk', 'data'=>$data_sm, 'backgroundColor'=>'rgba(0, 188, 200, 0.8)'];
                }
                else{
                    $data_label[]=['label'=>'Surat Keluar', 'data'=>$data_sk, 'backgroundColor'=>'rgba(233, 30, 99, 0.8)'];
                }
            }


        }



        echo json_encode(['label'=>$labels, 'datasets'=>$data_label]);
    }



}

