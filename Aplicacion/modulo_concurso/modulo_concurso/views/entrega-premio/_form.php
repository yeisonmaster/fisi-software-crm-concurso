<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrega-premio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'premio_producto_id')->textInput() ?>

    <?= $form->field($model, 'premio_tipo_id')->textInput() ?>

    <?= $form->field($model, 'interlocutor_comercial_id')->textInput() ?>

    <?= $form->field($model, 'campana_solicitud')->textInput() ?>

    <?= $form->field($model, 'campana_entrega')->textInput() ?>

    <?= $form->field($model, 'fecha_solicitud')->textInput() ?>

    <?= $form->field($model, 'fecha_entrega')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
