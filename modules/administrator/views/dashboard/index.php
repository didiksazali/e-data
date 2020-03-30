<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\search\StafSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'e-Data PKDP Online');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Advanced Form Example With Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2><?= strtoupper(Html::encode($this->title)); ?></h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Reload</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <?php if (Yii::$app->session->hasFlash('create_success')): ?>
                    <div class="alert bg-green alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <?= Yii::$app->session->getFlash('create_success') ?>
                    </div>
                <?php endif; ?>
                  <div class="alert alert-success">
                                <strong>Welcome!</strong> Semoga Hari Anda Menyenangkan :D
                  </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Advanced Form Example With Validation -->


<?php
$homeUrl=Yii::$app->homeUrl;
$csrf=Yii::$app->request->getCsrfToken();
$js=<<< JAVASCRIPT

$('document').ready(function(){
    $.ajax({
        url:'$homeUrl\administrator/dashboard/get_sekolah_chart_json',
        dataType:'json',
        success:function(data){
            new Chart(document.getElementById("bar_chart").getContext("2d"), {
            type: 'bar',
            data: {
                labels: data.label,
                datasets: data.datasets,
            },

            options: {
                responsive: true,
                legend: false,
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
            }
        });

        }
    });


});


JAVASCRIPT;
$this->registerJS($js);
?>
