<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntregaPremioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entrega Premios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-premio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Entrega Premio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'premio_producto_id',
            'premio_tipo_id',
            'interlocutor_comercial_id',
            'campana_solicitud',
            'campana_entrega',
            // 'fecha_solicitud',
            // 'fecha_entrega',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
