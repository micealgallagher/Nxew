<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'View Account';
?>
<div class="account-view">

<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-4 col-lg-4 col-sm-5">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 30px">
                    <?= Html::encode($user->getFullName()) ?>
                </h3>
            </div>
            <div class="panel-body">
                <?= Html::encode($account->bio) ?>
            </div>
            <div class="panel-body">
                <?php
                if ( $account->hasAnySocialItems() ) {

                    if (strlen($account->website) > 0) {
                        $options = ['class' => 'fa fa-home fa-3x social-icon'];
                        $icon = Html::tag('i', '', $options);

                        echo Html::a($icon, $account->website);
                    }

                    if (strlen($account->twitter) > 0) {
                        $options = ['class' => 'fa fa-twitter-square fa-3x social-icon'];
                        $icon = Html::tag('i', '', $options);

                        echo Html::a($icon, $account->twitter);
                    }

                    if (strlen($account->facebook) > 0) {
                        $options = ['class' => 'fa fa-facebook-square fa-3x social-icon'];
                        $icon = Html::tag('i', '', $options);

                        echo Html::a($icon, $account->facebook);
                    }

                    if (strlen($account->soundcloud) > 0) {
                        $options = ['class' => 'fa fa-soundcloud fa-3x social-icon'];
                        $icon = Html::tag('i', '', $options);

                        echo Html::a($icon, $account->soundcloud);
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-8 col-sm-7">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 30px">
                    Playlist
                </h3>
            </div>
            <div class="panel-body playlist-container">
                <?php
                if ( isset($playlistTracks) && sizeof($playlistTracks) > 0) {
                    $trackUrls = '';
                    $trackIndex = 0;
                    foreach ( $playlistTracks as $track ) {
                        $artworkUrl = $track->artwork_url;
                        $title = $track->title;
                        $user = $track->user_username;
                        $genre = $track->genre;

                        $trackUrls .= '"' . $track->permalink_uri . '",';

                        ?>

                        <div class="panel panel-default playlist-track">
                            <div class="panel-body track-container-<?= $trackIndex?>" style="padding: 0px">
                                <div class="row">
                                    <div class="col-md-2 col-lg-2 col-sm-4, col-xs-2" style="padding-top: 0px">
                                        <?= Html::img($artworkUrl) ?>
                                    </div>
                                    <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="padding-left: 30px; padding-top: 5px;">
                                        <div class="row">
                                            <?= Html::tag('strong', $title) ?>
                                            <?= Html::tag('p', $user) ?>
                                        </div>
                                        <div id="track-controls" class="row">
                                            <i class="fa fa-play-circle fa-2x control-hover" track-index="<?= $trackIndex++ ?>"></i>
                                            <i class="track-pause fa fa-pause fa-2x"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <!--<div class="panel panel-default playlist-track">
                            <div class="panel-body">
                                <strong>21st Century Schizoid Man</strong>
                                <p>
                                    King Crimson
                                </p>
                            </div>
                        </div>-->
                        <?php
                    }

                    if ( isset($trackUrls) ) {
                        echo Html::script('var trackUrls = [' . $trackUrls . ']');
                    }
                } else {
                    echo '<div id="divSoundCouldUrl" style="margin:20px" class="alert alert-info" role="alert">';
                    echo ':( No music!? What the what!?';
                    echo '</div>';

                }
                ?>

            </div>





        </div>
    </div>
</div>


</div>
