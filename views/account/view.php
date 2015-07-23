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
                        <?php

                            $options = ['class' => 'btn btn-default pull-right fa fa-cog fa-1x'];
                            $icon = Html::tag('i', '', $options);

                            echo Html::a($icon, ['/account/settings', 'id' => $account->user_id]);
                        ?>
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
                        }
                    ?>
                    <div class="form-group">
                        <?php
                            $options = ['class' => 'fa fa-pencil fa-1x'];
                            $icon = Html::tag('i', '', $options);
                            echo Html::a($icon, ['/account/update', 'id' => $account->id], ['class'=>'btn btn-success pull-right '])
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-7">
            <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 30px">
                    Playlist
                    <div id="divAddSoundCloudDropDown" class="dropdown pull-right">

                        <?php

                            if ( isset($maxNumberOfTracksReached) && $maxNumberOfTracksReached ) {


                                $buttonOptions = ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-sm'];
                                $iconOptions = ['class' => 'fa fa-plus fa-1x'];
                                $icon = Html::tag('i', '', $iconOptions);

                                echo Html::button($icon, $buttonOptions);
                            } else {
                                ?>

                                <button class="btn btn-success dropdown-toggle" type="button" id="addSoundCloudTrack" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-plus fa-1x"></i>
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="addSoundCloudTrack" style="padding: 20px">
                                    <div id="divSoundCouldUrl" style="display:none" class="alert alert-danger" role="alert"></div>
                                    <li>
                                        <div class="input-group">
                                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-soundcloud"></i>
                                        </span>
                                                <input type="text" id="txtSoundCloudURL" class="form-control" placeholder="SoundCloud Track URL" style="height: 48px; width: 300px" />
                                        <span class="input-group-btn">
                                            <?php $options = ['class' => 'fa fa-floppy-o'] ?>
                                            <?= $icon = Html::tag('i', '', $options) ?>
                                            <?= Html::script('var addToPlaylistUrl = \'' . Url::toRoute('playlist/add') . '\'') ?>
                                            <?= Html::a($icon, '', ['onclick' => 'return resolveAndSubmitSCUrl(' . $account->id . ')', 'class'=>'btn btn-success', 'style' => 'height: 48px; width: 48px; padding-top: 25%']) ?>
                                        </span>
                                            </div>
                                            <div class="input-group-btn">

                                            </div>


                                        </div>
                                    </li>
                                </ul>
                            <?php
                            }
                            ?>

                        <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Cannot add track</button>-->



                    </div>
                </h3>
            </div>
            <div class="panel-body playlist-container">
                <?php
                    if ( isset($playlistTracks) && sizeof($playlistTracks) > 0) {
                        $trackUrls = '';
                        foreach ( $playlistTracks as $track ) {
                            $artworkUrl = $track->artwork_url;
                            $title = $track->title;
                            $genre = $track->genre;

                            $trackUrls .= '"' . $track->permalink_uri . '",';

                ?>

                            <div class="panel panel-default playlist-track">
                                <div class="panel-body" style="padding: 0px">
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 col-sm-4, col-xs-2" style="padding-top: 0px">
                                            <?= Html::img($artworkUrl) ?>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="padding-left: 30px; padding-top: 5px;">
                                            <div class="row">
                                                <?= Html::tag('strong', $title) ?>
                                                <?= Html::tag('p', $genre) ?>
                                            </div>
                                            <div id="trackControls" class="row">
                                                <i class="fa fa-play-circle fa-2x"></i>
                                                <i class="fa fa-pause fa-2x"></i>
                                                <i class="fa fa-stop fa-2x"></i>
                                                <i class="trackLikeUp fa fa-thumbs-up fa-2x"></i>
                                                <i class="trackLikeDown fa fa-thumbs-down fa-2x"></i>
                                                <i class="trackSoundCloudProfile fa fa-soundcloud fa-2x"></i>
                                                <i class="trackDownload fa fa-download fa-2x"></i>
                                                <i class="fa fa-trash-o fa-2x pull-right" style="padding-right:36px"></i>
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
                            echo ':( where is the music?';
                        echo '</div>';

                    }
                ?>

            </div>

                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="mySmallModalLabel">No more tracks for you!</h4>
                            </div>
                            <div class="modal-body">
                                <?= 'Sorry, but you are not allowed to add any more than ' . (isset($playlistTracks) ? sizeof($playlistTracks) : -1) . ' tracks' ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">:( OK</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>


            </div>
        </div>
    </div>


</div>
