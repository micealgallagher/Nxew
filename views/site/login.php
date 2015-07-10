<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
?>     


<div class="row">
    <div class="col-xs-12 col-md-12 text-center title-bottom-padding">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-4"></div>
  <div class="col-xs-6 col-md-4 text-center">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button', 'style' => 'width: 100%']) ?>
                </div>
                                <div style="color:white;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset'], ['style' => 'color: orange']) ?>.
                </div>
            <?php ActiveForm::end(); ?>
  </div>
  <div class="col-xs-6 col-md-4"></div>
</div>
