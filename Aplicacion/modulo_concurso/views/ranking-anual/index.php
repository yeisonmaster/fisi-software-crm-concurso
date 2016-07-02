<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RankingAnualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ranking Anuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranking-anual-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Ranking Anual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anio',
            'nombre',
            'fecha_ranking',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
