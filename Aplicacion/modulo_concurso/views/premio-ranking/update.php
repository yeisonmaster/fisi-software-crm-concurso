<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PremioRanking */

$this->title = 'Actualizar Premio Ranking: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Premio Rankings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="premio-ranking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
