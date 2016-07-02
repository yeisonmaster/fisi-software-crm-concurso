<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PuntajeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puntajes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Puntaje', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'campana_id',
            'pedido_detalle_id',
            'puntaje_actual',
            'puntaje_acumulado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
