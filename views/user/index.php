<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
?>
<div class="user-index">


    <?= Yii::$app->basePath . ' base path' ?>
    <?= Yii::$app->homeUrl . ' home url' ?>
    <?= Yii::$app->urlManager->baseUrl . ' URL Manage home url' ?>
    <?= Yii::$app->urlManager->hostInfo . ' URL Manage host info' ?>
    <?= Yii::$app->request->pathInfo . ' request Path info' ?>
    <?= Yii::$app->request->userHost . ' user host' ?>
    <?= Yii::$app->request->absoluteUrl . ' absolutle url ' ?>
    <?= Yii::$app->request->getUrl() . '  url ' ?>
    <?= Yii::$app->getHomeUrl(). '  home url path' ?>
    <?= Yii::$app->getVendorPath(). '  vender path' ?>
    <?= Yii::$app->getUrlManager()->getBaseUrl(). '  base url ' ?>

    <p>
        <?= Yii::$app->urlManager->baseUrl . ' URL Manage home url' ?>
    </p>
    <p>
        <?= Yii::$app->urlManager->hostInfo . Yii::$app->urlManager->baseUrl  . ' URL Manage host info' ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'type',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
