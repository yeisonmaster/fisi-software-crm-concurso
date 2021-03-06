<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PremioTipo */

$this->title = 'Actualizar Premio Tipo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Premio Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="premio-tipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
