<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Puntaje */

$this->title = 'Update Puntaje: ' . $model->campana_id;
$this->params['breadcrumbs'][] = ['label' => 'Puntajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->campana_id, 'url' => ['view', 'campana_id' => $model->campana_id, 'pedido_detalle_id' => $model->pedido_detalle_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puntaje-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
