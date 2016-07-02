<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\NivelPremioAnual */

$this->title = $model->ranking_anual_anio;
$this->params['breadcrumbs'][] = ['label' => 'Nivel Premio Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nivel-premio-anual-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ranking_anual_anio' => $model->ranking_anual_anio, 'nivel_ranking_id' => $model->nivel_ranking_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ranking_anual_anio' => $model->ranking_anual_anio, 'nivel_ranking_id' => $model->nivel_ranking_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ranking_anual_anio',
            'nivel_ranking_id',
            'nombre',
            'puntaje_minimo',
            'puntaje_hasta',
        ],
    ]) ?>

</div>
