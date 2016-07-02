<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\InterlocutorComercial;
use app\models\PremioRanking;


/* @var $this yii\web\View */
/* @var $model app\models\EntregaPremioRanking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body ">
    <div class="row no-margin">
        <div class="col-lg-12"
			<div class="entrega-premio-ranking-form">

			    <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal bordered-group'],
                    'fieldConfig' => [
                        'template' => '{label}<div class="col-sm-10 col-lg-4">{input}{hint}{error}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-4 control-label'
                        ]
                    ]
                ]); ?>

			    <?= $form->field($model, 'interlocutor_comercial_id')->dropDownList(ArrayHelper::map(InterlocutorComercial::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Interlocutor Comercial'])->label(Yii::t('app','Interlocutor Comercial')) ?>

			    <?= $form->field($model, 'premio_ranking_id')->dropDownList(ArrayHelper::map(PremioRanking::find()->all(),'id','nombre'),['prompt'=>'Seleccionar Premio Ranking'])->label(Yii::t('app','Premio Ranking')) ?>

			    <?= $form->field($model, 'fecha_entrega')->textInput() ?>

			    <div class="form-group">
			        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			    </div>

			    <?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</div>
