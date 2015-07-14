<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update account';
?>
<div class="account-create">

<h1><?= Html::encode($this->title) ?></h1>


<?php if ( (isset($isUpdated) ? $isUpdated : false) ) {
    $options = ['class' =>'alert alert-success'];
    echo Html::tag('div', '<strong>Updated!</strong> Bio updated successfully.', $options);
}?>

<?php if ( (isset($isSaved) ? $isSaved : false) ) {
    $options = ['class' =>'alert alert-success'];
    echo Html::tag('div', '<strong>Saved!</strong> Bio created successfully.', $options);
}?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>
