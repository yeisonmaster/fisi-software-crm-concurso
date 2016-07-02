<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PuntajeCampana */

$this->title = $model->campana_id;
$this->params['breadcrumbs'][] = ['label' => 'Puntaje Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntaje-campana-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'campana_id' => $model->campana_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'campana_id' => $model->campana_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id], [
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
            'campana_id',
            'interlocutor_comercial_id',
            'puntaje_actual',
            'puntaje_acumulado',
        ],
    ]) ?>

</div>
