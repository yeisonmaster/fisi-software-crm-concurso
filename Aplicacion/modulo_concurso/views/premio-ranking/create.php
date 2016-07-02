<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PremioRanking */

$this->title = 'Crear Premio Ranking';
$this->params['breadcrumbs'][] = ['label' => 'Premio Rankings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-ranking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
