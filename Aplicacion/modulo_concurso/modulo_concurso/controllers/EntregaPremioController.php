<?php

namespace app\controllers;

use Yii;
use app\models\EntregaPremio;
use app\models\EntregaPremioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntregaPremioController implements the CRUD actions for EntregaPremio model.
 */
class EntregaPremioController extends Controller
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
     * Lists all EntregaPremio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntregaPremioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntregaPremio model.
     * @param integer $premio_producto_id
     * @param integer $premio_tipo_id
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionView($premio_producto_id, $premio_tipo_id, $interlocutor_comercial_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($premio_producto_id, $premio_tipo_id, $interlocutor_comercial_id),
        ]);
    }

    /**
     * Creates a new EntregaPremio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntregaPremio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'premio_producto_id' => $model->premio_producto_id, 'premio_tipo_id' => $model->premio_tipo_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EntregaPremio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $premio_producto_id
     * @param integer $premio_tipo_id
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionUpdate($premio_producto_id, $premio_tipo_id, $interlocutor_comercial_id)
    {
        $model = $this->findModel($premio_producto_id, $premio_tipo_id, $interlocutor_comercial_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'premio_producto_id' => $model->premio_producto_id, 'premio_tipo_id' => $model->premio_tipo_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EntregaPremio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $premio_producto_id
     * @param integer $premio_tipo_id
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionDelete($premio_producto_id, $premio_tipo_id, $interlocutor_comercial_id)
    {
        $this->findModel($premio_producto_id, $premio_tipo_id, $interlocutor_comercial_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EntregaPremio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $premio_producto_id
     * @param integer $premio_tipo_id
     * @param integer $interlocutor_comercial_id
     * @return EntregaPremio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($premio_producto_id, $premio_tipo_id, $interlocutor_comercial_id)
    {
        if (($model = EntregaPremio::findOne(['premio_producto_id' => $premio_producto_id, 'premio_tipo_id' => $premio_tipo_id, 'interlocutor_comercial_id' => $interlocutor_comercial_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
