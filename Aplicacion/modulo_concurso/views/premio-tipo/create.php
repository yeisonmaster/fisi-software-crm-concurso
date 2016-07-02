<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PremioTipo */

$this->title = 'Crear Premio Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Premio Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-tipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
