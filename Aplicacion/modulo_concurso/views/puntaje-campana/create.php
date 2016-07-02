<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PuntajeCampana */

$this->title = 'Crear Puntaje Campana';
$this->params['breadcrumbs'][] = ['label' => 'Puntaje Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntaje-campana-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
