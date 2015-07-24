<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->title = 'Password Reset';
?>
<center>
    <?php
        $imgOptions = ['height' => '80px', 'alt' => ' Nxew Logo'];
        $imgUrl = Yii::$app->urlManager->hostInfo . Yii::$app->urlManager->baseUrl . '/img/nxewlogogoose.png';

        echo Html::img($imgUrl, $imgOptions)
    ?>
    <hr width="50%"/>
    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Click the link below to reset your password</h3>
    <?= Html::a('Reset me!', Url::to(['site/reset-password', 'token' => $user->password_reset_token], true)) ?>
    <hr width="50%"/>
    <i>The Sign Painter</i>
</center>
