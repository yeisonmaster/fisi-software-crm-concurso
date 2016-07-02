<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremio */

$this->title = 'Crear Entrega Premio';
$this->params['breadcrumbs'][] = ['label' => 'Entrega Premios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-premio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
