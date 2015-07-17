<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Account;
use app\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
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
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param string $id
     * @return mixed
     */
    public function actionView()
    {
        $id = Yii::$app->getUser()->id;
        $account = Account::findOne(['user_id' => $id]);
        $user = User::findOne(['id' => $id ]);

        return $this->render('view', [
            'account' => $account,
            'user' => $user,
        ]);

        /*if ( isset($account) ) {
            $submittedModel = new Account();

            $hasBioBeenUpdated = false;
            if ($submittedModel->load(Yii::$app->request->post())) {
                $hasBioBeenUpdated = $submittedModel->hasBioChanged($account->bio);
            }

            if ( $hasBioBeenUpdated ) {
                $submittedModel->id = $account->id;
                $submittedModel->isNewRecord = false;
                $submittedModel->user_id = $id;
                $bio = $submittedModel->bio;
                $website = $submittedModel->website;
                $submittedModel->bio =  ' ';
                $submittedModel->website =  ' ';

                // Not sure why but the bio isn't been added to the update statement executed by ActiveRecord
                // Saving the record twice seems to do the trick
                $submittedModel->save(false);
                $submittedModel->bio = $bio;
                $submittedModel->website = $website;
                $submittedModel->save(false);

                return $this->render('update', [
                    'model' => $submittedModel,
                    'isUpdated' => true,
                ]);
            } else {
                return $this->render('update', [
                    'model' => $account,
                ]);
            }

        } else {
            Yii::info('MGDEV - no account found');
            $model = new Account();
            return $this->redirect(['create', 'model' => $model]);
        }*/
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::info('MGDEV - attempting to create account');
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
