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
                                $icon = Html::tag('i', '', $options);ii::app()->request->getParam('delete');

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

                                echo Html::a($icon, $account->facebook);ii::app()->request->getParam('delete');
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
                        <button class="btn btn-success dropdown-toggle" type="button" id="addSoundCloudTrack" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-plus fa-1x"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="addSoundCloudTrack" style="padding: 20px">
                                    <div id="divSoundCouldUrl" style="display:none" class="alert alert-danger" role="alert"></div>
                            <li>
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-soundcloud"></i>
                                        </span>
                                        <input type="text" id="txtSoundCloudURL" class="form-control" placeholder="SoundCloud URL" aria-label="Amount (to the nearest dollar)" style="height: 48px; width: 300px" />
                                        <span class="input-group-btn">
                                            <?php $options = ['class' => 'fa fa-pencil'] ?>
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
                    </div>
                </h3>
            </div>
            <div class="panel-body playlist-container">
                <div class="panel panel-default playlist-track">
                    <div class="panel-body">
                        <strong>Pushit</strong>
                        <p>
                            Tool - Lateralus
                        </p>
                    </div>
                </div>
                <div class="panel panel-default playlist-track">
                    <div class="panel-body">
                        <strong>21st Century Schizoid Man</strong>
                        <p>
                            King Crimson
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
