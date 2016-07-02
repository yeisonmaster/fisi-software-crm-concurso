<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RankingAnual */

$this->title = 'Create Ranking Anual';
$this->params['breadcrumbs'][] = ['label' => 'Ranking Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranking-anual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
