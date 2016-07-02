<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RankingAnual */

$this->title = 'Actualizar Ranking Anual: ' . $model->anio;
$this->params['breadcrumbs'][] = ['label' => 'Ranking Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anio, 'url' => ['view', 'id' => $model->anio]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="ranking-anual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
