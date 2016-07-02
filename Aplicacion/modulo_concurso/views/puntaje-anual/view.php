<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PuntajeAnual */

$this->title = $model->ranking_anual_anio;
$this->params['breadcrumbs'][] = ['label' => 'Puntaje Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntaje-anual-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ranking_anual_anio' => $model->ranking_anual_anio, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ranking_anual_anio' => $model->ranking_anual_anio, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id], [
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
            'ranking_anual_anio',
            'interlocutor_comercial_id',
            'puntaje_acumulado',
        ],
    ]) ?>

</div>
