<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
?>
<div class="site-signup">
    
    <div class="row">
        <div class="col-xs-12 col-md-12 text-center title-bottom-padding">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="row">
      <div class="col-xs-6 col-md-4"></div>
      <div class="col-xs-6 col-md-4 text-center">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <?= $form->field($model, 'username') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'style' => 'width: 100%']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
      </div>
      <div class="col-xs-6 col-md-4"></div>
    </div>

</div>