<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremioRanking */

$this->title = 'Crear Entrega Premio Ranking';
$this->params['breadcrumbs'][] = ['label' => 'Entrega Premio Rankings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-premio-ranking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
