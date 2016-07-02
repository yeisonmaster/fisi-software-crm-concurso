<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PuntajeAnualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puntaje Anuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntaje-anual-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Puntaje Anual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ranking_anual_anio',
            'interlocutor_comercial_id',
            'puntaje_acumulado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
