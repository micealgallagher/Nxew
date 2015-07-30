<?php

namespace app\controllers;

use app\models\AddTrackSoundCloudForm;
use app\models\PlaylistTrack;
use app\models\SecurityForm;
use app\models\User;
use app\models\UserDetail;
use Yii;
use app\models\Account;
use app\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\common\Constant;

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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'settings'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $id = Yii::app()->request->getParam('id', -1);
                            $account = Account::findOne(['id' => $id]);

                            return $account->user_id == Yii::$app->user->getId();
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['settings'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $id = Yii::$app->request->getQueryParam('id');

                            return $id == Yii::$app->getUser()->id;
                        }
                    ]
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
     * Lists all Account models.
     * @return mixed
     */
    public function actionSettings($id)
    {
        $user = User::findOne(['id' => $id]);
        $userDetail = new UserDetail();
        $account = Account::findOne(['user_id' => $id]);

        if ( isset($user) ) {
            $userDetail->userId = $user->id;
            $userDetail->forename = $user->forename;
            $userDetail->surname = $user->surname;
        }

        $securityForm = new SecurityForm();
        return $this->render('../setting/update', [
            'userDetail' => $userDetail,
            'securityForm' => $securityForm,
            'account' => $account,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param string $id
     * @return mixed
     */
    public function actionView()
    {
        Yii::info('MGDEV - ActionController called ');
        $id = Yii::$app->getUser()->id;
        $account = Account::findOne(['user_id' => $id]);
        $addSoundCloud = new AddTrackSoundCloudForm();
        if ( isset($account) ) {
            $user = User::findOne(['id' => $id ]);

            $playlistTracks = PlaylistTrack::findAll(['account_id' => $account->id]);
            Yii::info('MGDEV - Number of tracks for account ' . $account->id . ' is '  . sizeof($playlistTracks));

            $maxNumberOfTracksReached = sizeof($playlistTracks) >= Constant::MAX_NUMBER_OF_TRACKS;

            return $this->render('view', [
                'account' => $account,
                'user' => $user,
                'addSoundCloud' => $addSoundCloud,
                'playlistTracks' => $playlistTracks,
                'maxNumberOfTracksReached' => $maxNumberOfTracksReached,
            ]);
        } else {
            $account = new Account();
            $id = Yii::$app->getUser()->id;
            $user = User::findOne(['id' => $id]);

            return $this->render('create', [
                'model' => $account,
                'user' => $user,
                'addSoundCloud' => $addSoundCloud,
            ]);
        }


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

                [
                    [
                        'allow' => true,
                        'actions' => ['actionUserUpdate'],
                        'roles' => ['@'],
                    ],
                ]
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
                [
                    [
                        'allow' => true,
                        'actions' => ['actionUserUpdate'],Close
                        'roles' => ['@'],
                    ],
                ]
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

    public function actionUpdatePlaylistName()
    {
        Yii::info('MGDEV - Called the actionUpdateName in PlaylistController');
        $account = Account::findOne(['user_id' => Yii::$app->user->id]);

        if ($account->load(Yii::$app->request->post())) {

            if ( strlen($account->playlist_name) < 3 ) {
                $account->playlist_name = Constant::DEFAULT_PLAYLIST_NAME;
            }

            Yii::info('MGDEV - ISSET ' . isset($account->playlist_name) . ' LENGTH ' . strlen($account->playlist_name));
            $account->save(false);
        }

        return $this->redirect(['account/view']);
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
        $userId = $model->user_id;

        $account = Account::findOne(['user_id' => $userId]);

        if ( $userId == Yii::$app->getUser()->id) {

            $user = User::findOne(['id' => $userId]);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'user' => $user,
                    'account' => $account,
                ]);
            }
        } else {

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
