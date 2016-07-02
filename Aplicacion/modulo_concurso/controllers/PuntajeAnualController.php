<?php

namespace app\controllers;

use Yii;
use app\models\PuntajeAnual;
use app\models\PuntajeAnualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PuntajeAnualController implements the CRUD actions for PuntajeAnual model.
 */
class PuntajeAnualController extends Controller
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
     * Lists all PuntajeAnual models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PuntajeAnualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PuntajeAnual model.
     * @param integer $ranking_anual_anio
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionView($ranking_anual_anio, $interlocutor_comercial_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ranking_anual_anio, $interlocutor_comercial_id),
        ]);
    }

    /**
     * Creates a new PuntajeAnual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PuntajeAnual();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ranking_anual_anio' => $model->ranking_anual_anio, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PuntajeAnual model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ranking_anual_anio
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionUpdate($ranking_anual_anio, $interlocutor_comercial_id)
    {
        $model = $this->findModel($ranking_anual_anio, $interlocutor_comercial_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ranking_anual_anio' => $model->ranking_anual_anio, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PuntajeAnual model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ranking_anual_anio
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionDelete($ranking_anual_anio, $interlocutor_comercial_id)
    {
        $this->findModel($ranking_anual_anio, $interlocutor_comercial_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PuntajeAnual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ranking_anual_anio
     * @param integer $interlocutor_comercial_id
     * @return PuntajeAnual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ranking_anual_anio, $interlocutor_comercial_id)
    {
        if (($model = PuntajeAnual::findOne(['ranking_anual_anio' => $ranking_anual_anio, 'interlocutor_comercial_id' => $interlocutor_comercial_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
