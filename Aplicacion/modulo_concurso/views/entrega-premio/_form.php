<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\PremioProducto;
use app\models\PremioTipo;
use app\models\InterlocutorComercial;
use app\models\Campana;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body ">
    <div class="row no-margin">
        <div class="col-lg-12">

            <div class="entrega-premio-form">

                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal bordered-group'],
                    'fieldConfig' => [
                        'template' => '{label}<div class="col-sm-10 col-lg-4">{input}{hint}{error}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-4 control-label'
                        ]
                    ]
                ]); ?>

                <?= $form->field($model, 'premio_producto_id')->dropDownList(ArrayHelper::map(PremioProducto::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Premio Producto'])->label(Yii::t('app','Premio Producto')) ?>
                
                <?= $form->field($model, 'premio_tipo_id')->dropDownList(ArrayHelper::map(PremioTipo::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Premio Tipo'])->label(Yii::t('app','Tipo de Premio')) ?>
                
                <?= $form->field($model, 'interlocutor_comercial_id')->dropDownList(ArrayHelper::map(InterlocutorComercial::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Interlocutor Comercial'])->label(Yii::t('app','Interlocutor Comercial')) ?>
                 
                <?= $form->field($model, 'campana_solicitud')->dropDownList(ArrayHelper::map(Campana::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Campaña Solicitud'])->label(Yii::t('app','Campaña Solicitud')) ?>
                
                <?= $form->field($model, 'campana_entrega')->dropDownList(ArrayHelper::map(Campana::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Campaña Entrega'])->label(Yii::t('app','Campaña Entrega')) ?>
                
                <?= $form->field($model, 'fecha_solicitud')->textInput() ?>

                <?= $form->field($model, 'fecha_entrega')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
                
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>