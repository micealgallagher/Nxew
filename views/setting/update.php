<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update Settings';
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
<link href="../vendor/bower/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../vendor/bower/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Avatar
                </h3>
            </div>
            <div class="panel-body">

                <input id="input-id" type="file" class="file" data-preview-file-type="text">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Playlist Name
                </h3>
            </div>
            <div class="panel-body">
                <?php
                $form = ActiveForm::begin(['id' => 'update-account', 'action' => Yii::$app->getUrlManager()->createUrl(['account/update-playlist-name'])]);

                echo $form->field($account, 'playlist_name');
                echo Html::submitButton('Update', ['class' => 'btn btn-primary']);

                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Details
                </h3>
            </div>
            <div class="panel-body">
                <?php
                    $form = ActiveForm::begin(['id' => 'update-account', 'action' => Yii::$app->getUrlManager()->createUrl(['user/user-update'])]);

                    echo $form->field($userDetail, 'forename');
                    echo $form->field($userDetail, 'surname');

                    echo Html::submitButton('Update', ['class' => 'btn btn-primary']);

                    ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Security
                </h3>
            </div>
            <div class="panel-body">
                <?php
                    if ( (isset($passwordUpdatedSuccessfully) ? $passwordUpdatedSuccessfully : false) ) {
                        $options = ['class' =>'alert alert-success'];
                        echo Html::tag('div', '<strong>Updated!</strong> Password updated successfully.', $options);
                    }

                    $form = ActiveForm::begin(['id' => 'update-password', 'action' => Yii::$app->getUrlManager()->createUrl('user/user-password-reset')]);

                    echo $form->field($securityForm, 'currentPassword')->passwordInput();
                    echo $form->field($securityForm, 'newPassword')->passwordInput();
                    echo $form->field($securityForm, 'newPasswordAgain')->passwordInput();

                    echo Html::submitButton('Reset', ['class' => 'btn btn-primary']);

                    ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>



</div>
