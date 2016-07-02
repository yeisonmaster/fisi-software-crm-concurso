<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NivelPremioAnual */

$this->title = 'Update Nivel Premio Anual: ' . $model->ranking_anual_anio;
$this->params['breadcrumbs'][] = ['label' => 'Nivel Premio Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ranking_anual_anio, 'url' => ['view', 'ranking_anual_anio' => $model->ranking_anual_anio, 'nivel_ranking_id' => $model->nivel_ranking_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nivel-premio-anual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
