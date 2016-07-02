<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PuntajeCampana */

$this->title = 'Update Puntaje Campana: ' . $model->campana_id;
$this->params['breadcrumbs'][] = ['label' => 'Puntaje Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->campana_id, 'url' => ['view', 'campana_id' => $model->campana_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puntaje-campana-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
