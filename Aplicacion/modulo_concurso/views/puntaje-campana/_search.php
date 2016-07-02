<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PuntajeCampanaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puntaje-campana-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'campana_id') ?>

    <?= $form->field($model, 'interlocutor_comercial_id') ?>

    <?= $form->field($model, 'puntaje_actual') ?>

    <?= $form->field($model, 'puntaje_acumulado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
