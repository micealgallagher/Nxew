<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
?>
<div class="user-create">

    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php if ( ! (isset($success) ? $success : true) ) {
            $options = ['class' =>'alert alert-danger'];
            echo Html::tag('div', '<strong>Oh Snap!</strong> Failed to save user', $options);
            print_r($errors);
        } ?>
    </div>

</div>

<div class="row">
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
