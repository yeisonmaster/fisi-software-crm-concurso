<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PuntajeAnual */

$this->title = 'Crear Puntaje Anual';
$this->params['breadcrumbs'][] = ['label' => 'Puntaje Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntaje-anual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
