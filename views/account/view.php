<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

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
                    <h3 class="panel-title" style="vertical-align: middle; height: 30px">
                        <?= Html::encode($user->getFullName()) ?>
                        <?php

                            $options = ['class' => 'btn btn-default pull-right fa fa-cog fa-1x'];
                            $icon = Html::tag('i', '', $options);

                            echo Html::a($icon, $account->website);
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
                        <?= Html::a('Edit', ['/account/update', 'id' => $account->id], ['class'=>'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-7">
            <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Playlist
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
