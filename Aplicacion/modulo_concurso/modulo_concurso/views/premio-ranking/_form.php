<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PremioRanking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="premio-ranking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nivel_premio_anual_nivel_ranking_id')->textInput() ?>

    <?= $form->field($model, 'nivel_premio_anual_ranking_anual_anio')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
