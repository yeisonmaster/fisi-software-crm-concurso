<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntregaPremioRankingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entrega Premio Rankings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-premio-ranking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Entrega Premio Ranking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'interlocutor_comercial_id',
            'premio_ranking_id',
            'fecha_entrega',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
