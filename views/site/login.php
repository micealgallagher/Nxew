<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
?>

<?php
if ( isset($passwordReset) ? $passwordReset : false ) {
?>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?php
                $options = ['class' =>'alert alert-success'];
                echo Html::tag('div', '<strong>Updated!</strong> Password updated successfully.', $options);
            ?>
        </div>
    </div>
<?php
}
?>


<div class="row center-block" >
    <div class="col-xs-4 col-xs-offset-4 col-lg-4 col-lg-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h1><?= Html::encode($this->title) ?></h1></div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button', 'style' => 'width: 100%']) ?>
                </div>
                <div style="margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset'], ['style' => 'color: orange']) ?>.
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>