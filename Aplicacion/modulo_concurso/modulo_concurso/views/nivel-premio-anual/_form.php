<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NivelPremioAnual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nivel-premio-anual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ranking_anual_anio')->textInput() ?>

    <?= $form->field($model, 'nivel_ranking_id')->textInput() ?>

    <?= $form->field($model, 'puntaje_minimo')->textInput() ?>

    <?= $form->field($model, 'puntaje_hasta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
