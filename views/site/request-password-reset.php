<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Password reset';
?>

<div class="row">
    <?php
        $showResetFuncitonality = true;
        if ( isset($foundUser) ) {
            if ( $foundUser) {
                echo '<div class="row center-block" >';
                echo '<div class="col-xs-4 col-xs-offset-4 col-lg-4 col-lg-offset-4">';

                $showResetFuncitonality = false;
                $options = ['class' =>'alert alert-success'];
                echo Html::tag('div', '<strong>Reset Successfully!</strong> We\'ve sent a reset email to your email address', $options);

                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="row center-block" >';
                echo '<div class="col-xs-4 col-xs-offset-4 col-lg-4 col-lg-offset-4">';
                $options = ['class' =>'alert alert-danger'];
                echo Html::tag('div', '<strong>Oh Snap!</strong> We don\'t have a record of that email address', $options);
                echo '</div>';
                echo '</div>';
            }
        }
    ?>
</div>
<?php
    if ( $showResetFuncitonality ) {
?>
    <div class="row center-block" >
        <div class="col-xs-4 col-xs-offset-4 col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h1><?= Html::encode($this->title) ?></h1></div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset']); ?>
                    <?= $form->field($model, 'email') ?>
                    <div class="form-group pull-right">
                        <?= Html::submitButton('Reset me!', ['class' => 'btn btn-success', 'name' => 'add-user-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
<?php
    }
?>
