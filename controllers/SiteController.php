<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\AddUserForm;
use app\models\ContactForm;
use app\common\Constant;
use app\models\User;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', ''],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        Yii::info('MGDEV - actionLogin() has been called' );
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set(Constant::USER_TYPE, $model->type);
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /*public function actionLogin()
    {
        Yii::info('MGDEV - actionLogin() has been called' ); 
        if (! Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        $possibleUser = User::findByUsername($model->username);
       $possibleUser->actionAbout()
        Yii::info('MGDEV : about to log in!');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->security->validatePassword($model->password, '$2y$13$CqmT.GsjGmlpatsz3TAuCOjen1dOrjLr0bOz8RHHXPA4Z03vdzYKG')) {
            Yii::info('MGDEV : we are logged in!');
            Yii::$app->user->login($possibleUser);
            Yii::$app->session->set(Constant::USER_TYPE, $model->type);
            return $this->goBack();
        }

        
        return $this->render('login', [
            'model' => $model,
        ]);
    }*/

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->render('error', ['name' => 'Not authorized', 'message' => 'Please log in to view this page']);
        } else {
            return $this->render('about');
        }
        
    }
}
