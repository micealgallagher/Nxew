<?php

namespace app\controllers;

use app\models\SecurityForm;
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
                'only' => ['logout','reset-password'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['reset-password'],
                        'roles' => ['?'],
                        'matchCallback' => function ($rule, $action) {
                            Yii::info('MGDEV - testing reset-password');
                            Yii::info('MGDEV - token is ' . Yii::$app->request->get('token'));
                            $currentUser = User::findOne(['password_reset_token' => Yii::$app->request->get('token')]);

                            return isset($currentUser);
                        }
                    ],
                    [
                        'actions' => ['logout'],
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

    public function actionResetPassword() {

        $securityForm = new SecurityForm();
        $passwordUpdated = false;

        $token = Yii::$app->request->get('token');
        $user = User::findOne(['password_reset_token' => $token]);


        Yii::info('MGDEV - attempting to reset the password');

        if ($securityForm->load(Yii::$app->request->post())) {
            Yii::info('MgDEV - password reset token in actionResetPassword is ' . $token);

            if ( isset($user) ) {

                Yii::info('MGDEV - got the user');

                $user->updatePassword($securityForm->newPasswordAgain);

                Yii::info('MGDEV - Reset the password. Now redirecting');

                return $this->render('login', [
                    'model' => new LoginForm(),
                    'passwordReset' => true,
                ]);
            }
        } else {
            Yii::info('MGDEV - failed to reset the password');
        }

        Yii::info('MGDEV - We are calling the security form with the token: ' . $token);
        $securityForm->token = $token;

        return $this->render('reset-password', [
            'securityForm' => $securityForm,
        ]);
    }

    public function actionRequestPasswordReset() {
        $user = new User();

        Yii::info('MGDEV - requesting reset');
        if ($user->load(Yii::$app->request->post())) {
            Yii::info('MGDEV - Loading user');
            $user = User::findByUsername($user->email);
            $foundUser = isset($user);

            if ( $foundUser ) {
                Yii::info('MGDEV - Found user');
                $user->resetPassword();
                $user->save(false);

                Yii::$app->mailer->compose('contact/password-reset', ['user' => $user])
                    ->setFrom('password-reset@nxew.ca')
                    ->setTo('me@mehaul.me')
                    ->setSubject('Nxew - Password Reset')
                    ->send();
            } else {
                $user = new User();
            }

            return $this->render('request-password-reset', [
                'model' => $user,
                'foundUser' => $foundUser
            ]);
        }

        return $this->render('request-password-reset', [
            'model' => $user,
        ]);
    }

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
