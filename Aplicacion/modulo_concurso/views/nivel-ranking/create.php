<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NivelRanking */

$this->title = 'Crear Nivel Ranking';
$this->params['breadcrumbs'][] = ['label' => 'Nivel Rankings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nivel-ranking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
