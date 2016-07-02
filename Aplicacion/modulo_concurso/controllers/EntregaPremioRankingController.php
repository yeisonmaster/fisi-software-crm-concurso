<?php

namespace app\controllers;

use Yii;
use app\models\EntregaPremioRanking;
use app\models\EntregaPremioRankingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntregaPremioRankingController implements the CRUD actions for EntregaPremioRanking model.
 */
class EntregaPremioRankingController extends Controller
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
     * Lists all EntregaPremioRanking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntregaPremioRankingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntregaPremioRanking model.
     * @param integer $interlocutor_comercial_id
     * @param integer $premio_ranking_id
     * @return mixed
     */
    public function actionView($interlocutor_comercial_id, $premio_ranking_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($interlocutor_comercial_id, $premio_ranking_id),
        ]);
    }

    /**
     * Creates a new EntregaPremioRanking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntregaPremioRanking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'interlocutor_comercial_id' => $model->interlocutor_comercial_id, 'premio_ranking_id' => $model->premio_ranking_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EntregaPremioRanking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $interlocutor_comercial_id
     * @param integer $premio_ranking_id
     * @return mixed
     */
    public function actionUpdate($interlocutor_comercial_id, $premio_ranking_id)
    {
        $model = $this->findModel($interlocutor_comercial_id, $premio_ranking_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'interlocutor_comercial_id' => $model->interlocutor_comercial_id, 'premio_ranking_id' => $model->premio_ranking_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EntregaPremioRanking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $interlocutor_comercial_id
     * @param integer $premio_ranking_id
     * @return mixed
     */
    public function actionDelete($interlocutor_comercial_id, $premio_ranking_id)
    {
        $this->findModel($interlocutor_comercial_id, $premio_ranking_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EntregaPremioRanking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $interlocutor_comercial_id
     * @param integer $premio_ranking_id
     * @return EntregaPremioRanking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($interlocutor_comercial_id, $premio_ranking_id)
    {
        if (($model = EntregaPremioRanking::findOne(['interlocutor_comercial_id' => $interlocutor_comercial_id, 'premio_ranking_id' => $premio_ranking_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all PremioRankings models.
     * @return mixed
     */
    public function actionReporte($anio)
    {
        $command = Yii::$app->db->createCommand("CALL SP_LISTA_GANADORES_RANKING_ANUAL(:ANIO)");
        $dataProvider = $command->bindValue(":ANIO", $anio)->queryAll();

        //var_dump($dataProvider);

        return $this->render('reporte', [
            'dataProvider' => $dataProvider,
            'anio' => $anio
        ]);
    }
}
