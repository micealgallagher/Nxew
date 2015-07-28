<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'User: ' . $model->email;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ( (isset($recordAlreadyExists) ? $recordAlreadyExists : false) ) {
        $options = ['class' =>'alert alert-danger'];
        echo Html::tag('div', '<strong>User already exists!</strong> User was not added as one with the same email address already exists.', $options);
    }
    ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'forename',
            'surname',
            'email:email',
            'type',
        ],
    ]) ?>

</div>
