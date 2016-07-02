<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremioRanking */

$this->title = $model->interlocutor_comercial_id;
$this->params['breadcrumbs'][] = ['label' => 'Entrega Premio Rankings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-premio-ranking-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'interlocutor_comercial_id' => $model->interlocutor_comercial_id, 'premio_ranking_id' => $model->premio_ranking_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'interlocutor_comercial_id' => $model->interlocutor_comercial_id, 'premio_ranking_id' => $model->premio_ranking_id], [
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
            'interlocutor_comercial_id',
            'premio_ranking_id',
            'fecha_entrega',
        ],
    ]) ?>

</div>
