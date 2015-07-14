<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */


?>
<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'website') ?>
    <?= $form->field($model, 'facebook') ?>
    <?= $form->field($model, 'twitter') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
