<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NivelPremioAnualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nivel Premio Anuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nivel-premio-anual-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Nivel Premio Anual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ranking_anual_anio',
            'nivel_ranking_id',
            'puntaje_minimo',
            'puntaje_hasta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
