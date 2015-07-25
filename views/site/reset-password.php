<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'New Password';
?>

<div class="user-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ( (isset($passwordUpdatedSuccessfully) ? $passwordUpdatedSuccessfully : false) ) {
        $options = ['class' =>'alert alert-success'];
        echo Html::tag('div', '<strong>Updated!</strong> Password updated successfully.', $options);
    }

    $form = ActiveForm::begin(['id' => 'reset-password', 'action' => Yii::$app->getUrlManager()->createUrl(['site/reset-password', 'token' => $securityForm->token])]);

    echo $form->field($securityForm, 'newPassword')->passwordInput();
    echo $form->field($securityForm, 'newPasswordAgain')->passwordInput();

    echo Html::submitButton('Reset', ['class' => 'btn btn-primary']);

    ActiveForm::end();
    ?>

</div>
