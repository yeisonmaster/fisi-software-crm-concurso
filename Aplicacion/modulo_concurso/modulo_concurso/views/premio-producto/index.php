<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PremioProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Premio Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Premio Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'campana_id',
            'producto_id',
            'nombre',
            'estado',
            // 'puntaje_con_caje',
            // 'puntaje_sin_canje',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
