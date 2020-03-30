<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\AturanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aturans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aturan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aturan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_aturan',
            'asal',
            'tujuan',
            'transit',
            'dibuat_oleh',
            // 'dibuat_tanggal',
            // 'terakhir_diedit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
