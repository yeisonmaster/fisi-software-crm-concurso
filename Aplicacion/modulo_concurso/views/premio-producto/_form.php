<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Campana;
use app\models\Producto;

/* @var $this yii\web\View */
/* @var $model app\models\PremioProducto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body ">
    <div class="row no-margin">
        <div class="col-lg-12">

            <div class="premio-producto-form">

                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal bordered-group'],
                    'fieldConfig' => [
                        'template' => '{label}<div class="col-sm-10 col-lg-4">{input}{hint}{error}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-4 control-label'
                        ]
                    ]
                ]); ?>

                <?= $form->field($model, 'campana_id')->dropDownList(ArrayHelper::map(Campana::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Campaña'])->label(Yii::t('app','Campaña')) ?>
                
                <?= $form->field($model, 'producto_id')->dropDownList(ArrayHelper::map(Producto::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Producto'])->label(Yii::t('app','Producto')) ?>
                
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'estado')->dropDownList(['1' => 'Si', '0' => 'No'],['prompt'=>'Selecciona el Estado']); ?>
                
                <?= $form->field($model, 'puntaje_con_canje')->textInput() ?>
                
                <?= $form->field($model, 'puntaje_sin_canje')->textInput() ?>
                
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>