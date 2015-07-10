<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl . '/favicon.ico' ?>" type="image/x-icon">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img(Yii::$app->request->baseUrl . '/img/nxewlogo.png', ['width' => '220px']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $allMenuItems = [];
    $usersMenuItem = [];
    $loginMenuItem = [];

    if ( !Yii::$app->user->isGuest ) {
        $usersMenuItem = [
                'label' => 'Users ',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
    }

    if ( Yii::$app->user->isGuest ) {
        $loginMenuItem = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $loginMenuItem = [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
    }

    if ( $usersMenuItem ) {
        array_push($allMenuItems, $usersMenuItem);
    }
    if ( $loginMenuItem ) {
        array_push($allMenuItems, $loginMenuItem);
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $allMenuItems,
    ]);



    NavBar::end();
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Nxew <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
