<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PuntajeCampana */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puntaje-campana-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'campana_id')->textInput() ?>

    <?= $form->field($model, 'interlocutor_comercial_id')->textInput() ?>

    <?= $form->field($model, 'puntaje_actual')->textInput() ?>

    <?= $form->field($model, 'puntaje_acumulado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
