<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PremioRankingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Premio Rankings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-ranking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Premio Ranking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nivel_premio_anual_nivel_ranking_id',
            'nivel_premio_anual_ranking_anual_anio',
            'nombre',
            'estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
