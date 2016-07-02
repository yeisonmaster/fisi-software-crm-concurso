<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NivelPremioAnualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nivel-premio-anual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ranking_anual_anio') ?>

    <?= $form->field($model, 'nivel_ranking_id') ?>

    <?= $form->field($model, 'puntaje_minimo') ?>

    <?= $form->field($model, 'puntaje_hasta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
