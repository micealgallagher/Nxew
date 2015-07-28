<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php if ( (isset($isPasswordReset) ? $isPasswordReset : false) ) {
        $options = ['class' =>'alert alert-warning'];
        echo Html::tag('div', '<strong>Password Reset!</strong> Password has been reset and an email has been sent to the user', $options);
    } ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'forename')->textInput() ?>

    <?= $form->field($model, 'surname')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypeOptions())  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'create-or-update']) ?>
        <?php
            if ( !$model->isNewRecord ) {

                echo Html::submitButton('Reset Password', ['class' => 'btn btn-warning', 'name' => 'reset-password' ]);
            }
        ?>
    <?php ActiveForm::end(); ?>

    </div>


</div>
