<?php
namespace app\controllers;

use app\commands\LoadController;
use app\models\Comerciales;
use app\models\Comunidad;
use app\models\Llave;
use app\models\LlaveStatus;
use app\models\LlaveStatusSearch;
use app\models\LlaveUbicaciones;
use app\models\Perfiles;
use app\models\PerfilesUsuario;
use app\models\Propietarios;
use app\models\Registro;
use app\models\TipoLlave;
use app\models\User;
use app\models\util;
use kartik\grid\GridView;
use Yii;
use yii\bootstrap4\Html;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\widgets\Alert;


class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $arrParam = ['params'=>[]];
        $strActionForm = 'index';
        if (!Yii::$app->user->identity) {
            $arrReturn = self::setValidateUser();
            $strActionForm = $arrReturn[0];
            $arrParam = $arrReturn[1];
        }
        // --------------------------------
        // Parametros para usuarios que ya iniciaron sesion
        if (Yii::$app->user->identity) {
            // Cantidad de llave y llaves prestadas
            //$arrParam = ['params'=>Llave::getDataHome()];
        }

        return $this->render($strActionForm,$arrParam);
    }

    /**
     * Validar user - sesion
     * @return string|Response
     */
    private function setValidateUser(): array
    {
        $model = new LoginForm();
        $srtNotificacion = '';
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){

                $session = Yii::$app->session;
                !$session->isActive ? $session->open() : $session->close();
                $session->set('language', 'es');
                $session->close();

                $objPerfil = PerfilesUsuario::find()->where(['id_user'=>Yii::$app->user->identity->id ])->one();
                $strReturn = PerfilesUsuario::getIndexPerfil($objPerfil,$model);
                if(!empty($strReturn)){
                    return $this->redirect($strReturn);
                }
                $srtNotificacion .= "Validar los permisos asignados. \n";
            }
            $srtNotificacion .= "Validar los parámetros ingresados. \n";
            Yii::$app->user->logout();
            Yii::$app->user->logout(true);
        }

        return ['login', [
            'model' => $model,
            'notificacion' => $srtNotificacion
        ]];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $objPerfil = PerfilesUsuario::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
            if (!empty($objPerfil)) {

                    return $this->goHome();


            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @return \yii\console\Response|Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDownload()
    {
        $file=Yii::$app->request->get('file');
        $path=Yii::$app->request->get('path');
        $root=Yii::getAlias('@webroot').$path.$file;
        if (file_exists($root)) {
            return Yii::$app->response->sendFile($root);
        } else {
            throw new \yii\web\NotFoundHttpException("{$file} is not found!");
        }
    }

}
