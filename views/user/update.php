<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->email;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isPasswordReset' => isset($isPasswordReset) ? $isPasswordReset : false,
    ]) ?>

</div>
