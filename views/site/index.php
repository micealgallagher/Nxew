<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Nxew';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Nxew!</h1>

        <p class="lead">Discover while being discovered.</p>

    </div>

    <div class="body-content">

        <div class="row">
            
            <div class="col-lg-6 text-right">
                <?php
                    if ( Yii::$app->user->isGuest ) {
                        echo '<p>' . Html::a('Login', ['site/login'], ['class' => 'btn btn-lg btn-success home-page-buttons']) . '</p>';
                    } else {
                        echo '<p>' . Html::a('Edit Profile', ['site/login'], ['class' => 'btn btn-lg btn-success home-page-buttons']) . '</p>';
                    }
                ?>
            </div>
            <div class="col-lg-6">
                <?php
                    $options = ['class' => 'btn btn-lg btn-primary home-page-buttons'];
                    echo Html::a('Random Playlist', ['site/random-playlist'], $options);
                ?>
            </div>
            
        </div>

    </div>
</div>
