<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */


?>
<div class="account-form">

<div class="row">
    <div class="col-md-4 col-lg-4 col-sm-5">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= Html::encode($user->getFullName()) ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php
                if ( $model->isNewRecord ) {
                    $form = ActiveForm::begin(['id' => 'add-account', 'action' => Yii::$app->getUrlManager()->createUrl('account/create')]);
                } else {
                    $form = ActiveForm::begin(['id' => 'update-account']);
                }
                ?>

                <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'website') ?>
                <?= $form->field($model, 'facebook') ?>
                <?= $form->field($model, 'twitter') ?>


                <div class="form-group">

                    <?=  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>

                </div>

                <?php ActiveForm::end(); ?>
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
            <div class="panel-body">
            </div>
        </div>

    </div>
</div>
