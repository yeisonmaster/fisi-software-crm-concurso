<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PremioProducto */

$this->title = 'Create Premio Producto';
$this->params['breadcrumbs'][] = ['label' => 'Premio Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-producto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
