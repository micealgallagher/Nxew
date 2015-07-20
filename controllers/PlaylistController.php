<?php

namespace app\controllers;

use Yii;
use app\models\PlaylistTrack;
use app\models\Account;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class PlaylistController extends Controller
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
    public function actionAdd()
    {
        Yii::info('MGDEV - Called the actionAdd in PlaylistController');

        $account = Account::findOne(['user_id' => Yii::$app->user->id]);

        $request = Yii::$app->request;
        $track = json_decode($request->rawBody, true);

        $playlistTrack = PlaylistTrack::createFromArray($track);
        $playlistTrack->account_id = $account->id;
        $playlistTrack->save(false);

        Yii::info('MGDEV - Track title is: ' . $playlistTrack->title);


        return $this->redirect(['account/view']);
    }
}
