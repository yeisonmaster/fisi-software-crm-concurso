<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremio */

$this->title = $model->premio_producto_id;
$this->params['breadcrumbs'][] = ['label' => 'Entrega Premios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-premio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'premio_producto_id' => $model->premio_producto_id, 'premio_tipo_id' => $model->premio_tipo_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'premio_producto_id' => $model->premio_producto_id, 'premio_tipo_id' => $model->premio_tipo_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'premio_producto_id',
            'premio_tipo_id',
            'interlocutor_comercial_id',
            'campana_solicitud',
            'campana_entrega',
            'fecha_solicitud',
            'fecha_entrega',
        ],
    ]) ?>

</div>
