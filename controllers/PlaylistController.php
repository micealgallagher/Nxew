<?php

namespace app\controllers;

use Yii;
use app\models\PlaylistTrack;
use app\models\Account;
use app\common\Constant;

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
                    'delete' => ['get'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'settings'],
                'rules' => [
                    [
                    'allow' => false,
                    'actions' => ['delete'],
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        Yii::info('MGDEV delete authentication');
                        $accountId = Yii::$app->request->getQueryParam('accountId');

                        Yii::info('MGDEV delete authentication - accountId: ' . $accountId);

                        $account = Account::findOne(['id' => $accountId]);
                        $userId = $account->user_id;

                        Yii::info('MGDEV delete authentication user id: : ' . $userId);

                        return $userId == Yii::$app->getUser()->id;
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
        $playlistTracks = PlaylistTrack::findAll(['account_id' => $account->id]);

        if ( sizeof($playlistTracks) <= Constant::MAX_NUMBER_OF_TRACKS  ) {
            $request = Yii::$app->request;
            $track = json_decode($request->rawBody, true);

            $playlistTrack = PlaylistTrack::createFromArray($track);
            $playlistTrack->account_id = $account->id;
            $playlistTrack->save(false);

            Yii::info('MGDEV - Track title is: ' . $playlistTrack->title);
        }

        return $this->redirect(['account/view']);
    }

    public function actionDelete($accountId, $trackId)
    {
        Yii::info('MGDEV - Called the actionDelete in PlaylistController');
        $account = Account::findOne(['user_id' => Yii::$app->user->id]);
        PlaylistTrack::deleteAll(['id' => $trackId, 'account_id' => $accountId]);

        return $this->redirect(['account/view']);
    }
}
