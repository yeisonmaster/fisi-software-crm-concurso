   <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\NivelRanking;
use app\models\RankingAnual;

/* @var $this yii\web\View */
/* @var $model app\models\PremioRanking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body ">
    <div class="row no-margin">
        <div class="col-lg-12">
			<div class="premio-ranking-form">

			    <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal bordered-group'],
                    'fieldConfig' => [
                        'template' => '{label}<div class="col-sm-10 col-lg-4">{input}{hint}{error}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-4 control-label'
                        ]
                    ]
                ]); ?>

                <?= $form->field($model, 'nivel_premio_anual_nivel_ranking_id')->dropDownList(ArrayHelper::map(NivelRanking::find()->all(),'id','nombre'),['prompt'=>'Selecciona el Nivel Ranking Anual'])->label(Yii::t('app','Nivel Ranking Anual')) ?>

                <?= $form->field($model, 'nivel_premio_anual_ranking_anual_anio')->dropDownList(ArrayHelper::map(RankingAnual::find()->all(),'anio','nombre'),['prompt'=>'Selecciona el Ranking Anual'])->label(Yii::t('app','Ranking Anual')) ?>

			    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

			    <?= $form->field($model, 'estado')->dropDownList(['1' => 'Si', '0' => 'No'],['prompt'=>'Selecciona el Estado']); ?>

			    <div class="form-group">
			        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			    </div>

			    <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>