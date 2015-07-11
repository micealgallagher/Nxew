<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Add User';
?>     


<div class="row">
    <div class="col-xs-12 col-md-12 text-center title-bottom-padding">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-4"></div>
  <div class="col-xs-6 col-md-4">
    <?php $form = ActiveForm::begin(['id' => 'add-user']); ?>
                <?= $form->field($model, 'forename') ?>
                <?= $form->field($model, 'surname') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'type')->dropDownList($model->getTypeOptions()) ?>
                <div class="form-group pull-right">
                    <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'name' => 'add-user-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
  </div>
  <div class="col-xs-6 col-md-4"></div>
</div>
