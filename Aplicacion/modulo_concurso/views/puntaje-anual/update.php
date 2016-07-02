<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PuntajeAnual */

$this->title = 'Actualizar Puntaje Anual: ' . $model->ranking_anual_anio;
$this->params['breadcrumbs'][] = ['label' => 'Puntaje Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ranking_anual_anio, 'url' => ['view', 'ranking_anual_anio' => $model->ranking_anual_anio, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="puntaje-anual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
