<?php

namespace app\controllers;

use Yii;
use app\models\PuntajeCampana;
use app\models\PuntajeCampanaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PuntajeCampanaController implements the CRUD actions for PuntajeCampana model.
 */
class PuntajeCampanaController extends Controller
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
     * Lists all PuntajeCampana models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PuntajeCampanaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PuntajeCampana model.
     * @param integer $campana_id
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionView($campana_id, $interlocutor_comercial_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($campana_id, $interlocutor_comercial_id),
        ]);
    }

    /**
     * Creates a new PuntajeCampana model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PuntajeCampana();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'campana_id' => $model->campana_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PuntajeCampana model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $campana_id
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionUpdate($campana_id, $interlocutor_comercial_id)
    {
        $model = $this->findModel($campana_id, $interlocutor_comercial_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'campana_id' => $model->campana_id, 'interlocutor_comercial_id' => $model->interlocutor_comercial_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PuntajeCampana model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $campana_id
     * @param integer $interlocutor_comercial_id
     * @return mixed
     */
    public function actionDelete($campana_id, $interlocutor_comercial_id)
    {
        $this->findModel($campana_id, $interlocutor_comercial_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PuntajeCampana model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $campana_id
     * @param integer $interlocutor_comercial_id
     * @return PuntajeCampana the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($campana_id, $interlocutor_comercial_id)
    {
        if (($model = PuntajeCampana::findOne(['campana_id' => $campana_id, 'interlocutor_comercial_id' => $interlocutor_comercial_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
