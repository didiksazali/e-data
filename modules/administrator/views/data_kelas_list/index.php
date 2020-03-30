<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\search\DataKelasSearch2 */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kelas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    TABS WITH ICON TITLE
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home_with_icon_title" data-toggle="tab">
                            <i class="material-icons">home</i> HOME
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#profile_with_icon_title" data-toggle="tab">
                            <i class="material-icons">face</i> PROFILE
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                        <div class="container-fluid">
                            <div class="block-header">
                                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                            </div>
                            <!-- Basic Example -->
                            <div class="row clearfix">
                                <?php Pjax::begin(); ?>
                                <?= ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    'itemOptions' => ['class' => 'item'],
                                    'itemView' => function ($model, $key, $index, $widget) {
                                        return '<div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                    <div class="card">
                                        <div class="header bg-cyan">
                                            <h2>
                                                Cyan - Title <small>Description text here...</small>
                                            </h2>
                                            <ul class="header-dropdown m-r--5">
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">mic</i>
                                                    </a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                                        </div>
                                    </div>
                                </div>';
                                    },
                                    'pager' => [
                                            'class' => \kop\y2sp\ScrollPager::className(),
                                        'class' => \kop\y2sp\ScrollPager::className(),
                                        //'container' => '.grid-view tbody',
                                        //'item' => 'tr',
                                        //'paginationSelector' => '.grid-view .pagination',
                                        //'triggerText'=> 'fa fa-pencil',
                                        'eventOnScroll'=>null,
                                        'triggerTemplate' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><button class="btn btn-circle button-action" style="cursor: pointer;"><span class="fa fa-paperclip"></span></span></button></div>',
                                    ]
                                ]) ?>
                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                        <b>Profile Content</b>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
