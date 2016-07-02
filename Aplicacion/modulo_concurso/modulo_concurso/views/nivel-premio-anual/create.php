<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NivelPremioAnual */

$this->title = 'Create Nivel Premio Anual';
$this->params['breadcrumbs'][] = ['label' => 'Nivel Premio Anuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nivel-premio-anual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
