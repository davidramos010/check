<?php

namespace app\controllers;

use app\models\Conexion;
use app\models\ConexionSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConexionController implements the CRUD actions for conexion model.
 */
class ConexionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all conexion models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConexionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new conexión model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Conexion();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->user_id = Yii::$app->user->id;
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('yii', 'Se crea correctamente.'));
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCheck(): string
    {

        $objConexion = new Conexion();
        $arrHost = $objConexion->getHostCheck();
        $arrApi = $objConexion->getApiCheck();
        $arrBd = $objConexion->getDataBaseCheck();

        return $this->render('check', [
            'arrHost'=>$arrHost,
            'arrApi'=>$arrApi,
            'arrBd'=>$arrBd,
            'model' => $objConexion,
        ]);
    }

    /**
     * Updates an existing conexion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('yii', 'Se actualiza correctamente.'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the conexion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Conexion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Conexion::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
