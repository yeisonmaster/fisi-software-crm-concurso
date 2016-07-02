<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremioRanking */

$this->title = 'Update Entrega Premio Ranking: ' . $model->interlocutor_comercial_id;
$this->params['breadcrumbs'][] = ['label' => 'Entrega Premio Rankings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->interlocutor_comercial_id, 'url' => ['view', 'interlocutor_comercial_id' => $model->interlocutor_comercial_id, 'premio_ranking_id' => $model->premio_ranking_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entrega-premio-ranking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
