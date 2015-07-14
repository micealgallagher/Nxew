<?php

namespace app\controllers;

use app\common\Constant;
use Yii;
use app\models\User;
use app\models\AddUserForm;
use app\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $currentUser = User::findOne(['id' => Yii::$app->user->getId()]);
                            Yii::info('MGDEV - Current users type is: ' .$currentUser->type);
                            return strcmp(Constant::USER_TYPE_USER, $currentUser->type) != 0;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AddUserForm();

        if ($model->load(Yii::$app->request->post())) {

            $newUser = User::findOne(['username' => $model->email]);

            if ( isset($newUser) ) {
                return $this->render('view', [
                        'model' => $newUser,
                        'recordAlreadyExists' => true,
                    ]);
            } else {
                $newUser = new User();
                $newUser->forename = $model->forename;
                $newUser->surname = $model->surname;
                $newUser->username = $model->email;
                $newUser->email = $model->email;
                $newUser->type = $model->type;

                if ( $newUser->save(false) ) {
                    return $this->redirect(['view', 'id' => $newUser->id]);
                } else {
                    Yii::info("MGDEV - Failing to save");
                    return $this->render('create', [
                        'model' => $model,
                        'success' => false,
                        'errors' => $newUser->errors,
                    ]);
                }
            }


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(isset($_POST['reset-password'])) {
            $password = $model->resetPassword();
            $model->save();

            Yii::$app->mailer->compose('contact/password-reset', ['password' => $password])
                ->setFrom('password-reset@nxew.ca')
                ->setTo('me@mehaul.me')
                ->setSubject('Test')
                ->send();

            return $this->render('update', [
                'model' => $model,
                'isPasswordReset' => true,
            ]);
        } else {
            Yii::info('MGDEV - In the update action');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::info('MGDEV - redirecting to the view');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::info('MGDEV - rendering the update with id: ' . $model->email);
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }


        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelByUsername($username)
    {
        if (($model = User::findOne(['username' => $username])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}