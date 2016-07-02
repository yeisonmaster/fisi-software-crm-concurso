<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremioRankingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrega-premio-ranking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'interlocutor_comercial_id') ?>

    <?= $form->field($model, 'premio_ranking_id') ?>

    <?= $form->field($model, 'fecha_entrega') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
