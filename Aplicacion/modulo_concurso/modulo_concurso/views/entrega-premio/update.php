<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremio */

$this->title = 'Update Entrega Premio: ' . $model->premio_producto_id;
$this->params['breadcrumbs'][] = ['label' => 'Entrega Premios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->premio_producto_id, 'url' => ['view', 'premio_producto_id' => $model->premio_producto_id, 'premio_tipo_id' => $model->premio_tipo_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entrega-premio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
