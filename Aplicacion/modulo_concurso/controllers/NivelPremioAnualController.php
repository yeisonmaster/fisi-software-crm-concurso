<?php

namespace app\controllers;

use Yii;
use app\models\NivelPremioAnual;
use app\models\NivelPremioAnualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NivelPremioAnualController implements the CRUD actions for NivelPremioAnual model.
 */
class NivelPremioAnualController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NivelPremioAnual models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NivelPremioAnualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NivelPremioAnual model.
     * @param integer $ranking_anual_anio
     * @param integer $nivel_ranking_id
     * @return mixed
     */
    public function actionView($ranking_anual_anio, $nivel_ranking_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ranking_anual_anio, $nivel_ranking_id),
        ]);
    }

    /**
     * Creates a new NivelPremioAnual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NivelPremioAnual();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ranking_anual_anio' => $model->ranking_anual_anio, 'nivel_ranking_id' => $model->nivel_ranking_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NivelPremioAnual model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ranking_anual_anio
     * @param integer $nivel_ranking_id
     * @return mixed
     */
    public function actionUpdate($ranking_anual_anio, $nivel_ranking_id)
    {
        $model = $this->findModel($ranking_anual_anio, $nivel_ranking_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ranking_anual_anio' => $model->ranking_anual_anio, 'nivel_ranking_id' => $model->nivel_ranking_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing NivelPremioAnual model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ranking_anual_anio
     * @param integer $nivel_ranking_id
     * @return mixed
     */
    public function actionDelete($ranking_anual_anio, $nivel_ranking_id)
    {
        $this->findModel($ranking_anual_anio, $nivel_ranking_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NivelPremioAnual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ranking_anual_anio
     * @param integer $nivel_ranking_id
     * @return NivelPremioAnual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ranking_anual_anio, $nivel_ranking_id)
    {
        if (($model = NivelPremioAnual::findOne(['ranking_anual_anio' => $ranking_anual_anio, 'nivel_ranking_id' => $nivel_ranking_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
