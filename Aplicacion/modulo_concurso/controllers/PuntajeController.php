<?php

namespace app\controllers;

use Yii;
use app\models\Puntaje;
use app\models\PuntajeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PuntajeController implements the CRUD actions for Puntaje model.
 */
class PuntajeController extends Controller
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
     * Lists all Puntaje models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PuntajeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Puntaje model.
     * @param integer $campana_id
     * @param integer $pedido_detalle_id
     * @return mixed
     */
    public function actionView($campana_id, $pedido_detalle_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($campana_id, $pedido_detalle_id),
        ]);
    }

    /**
     * Creates a new Puntaje model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Puntaje();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'campana_id' => $model->campana_id, 'pedido_detalle_id' => $model->pedido_detalle_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Puntaje model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $campana_id
     * @param integer $pedido_detalle_id
     * @return mixed
     */
    public function actionUpdate($campana_id, $pedido_detalle_id)
    {
        $model = $this->findModel($campana_id, $pedido_detalle_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'campana_id' => $model->campana_id, 'pedido_detalle_id' => $model->pedido_detalle_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Puntaje model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $campana_id
     * @param integer $pedido_detalle_id
     * @return mixed
     */
    public function actionDelete($campana_id, $pedido_detalle_id)
    {
        $this->findModel($campana_id, $pedido_detalle_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Puntaje model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $campana_id
     * @param integer $pedido_detalle_id
     * @return Puntaje the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($campana_id, $pedido_detalle_id)
    {
        if (($model = Puntaje::findOne(['campana_id' => $campana_id, 'pedido_detalle_id' => $pedido_detalle_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
