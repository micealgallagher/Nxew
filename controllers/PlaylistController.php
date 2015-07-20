<?php

namespace app\controllers;

use Yii;
use app\models\Account;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\AddTrackSoundCloudForm;
use yii\helpers\Html;

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

        $request = Yii::$app->request;
        $soundCloudForm = new AddTrackSoundCloudForm();
        $soundCloudForm->accountId = $request->get('id', -1);
        $soundCloudForm->url = $request->get('track', '');

        $jsonObj = json_decode($request->rawBody);

        Yii::info('MGDEV - Content type is ' . $request->getContentType());
        Yii::info('MGDEV - Content type is ' . $request->rawBody);
        //Yii::info('MGDEV - Content type is ' . $jsonObj->{'title'});

        if ( isset($_REQUEST['track']) ) {
            Yii::info('MGDEV - variable value is ' . $_POST['track']);
        } else  {
            Yii::info('MGDEV - variable not set');
        }

        //Yii::info('MGDEV - content: ' . Html::encode(print_r($_POST, true)));
        //Yii::info('MGDEV - content: ' . $_POST['data']);



        return $this->redirect(['account/view', 'error' => $soundCloudForm]);
    }
}
