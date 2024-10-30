<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */
/* @var $notificacion string */

use kartik\password\PasswordInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->registerCssFile("@web/css/site.css", []);
$this->registerCssFile("@web/css/login.css", []);
?>


<div class="login-page" style="height: 87vh !important;">

    <div class="login-box">
        <div class="login-logo">
            <?= Html::img('@web/img/logo60px.png', ['style' => 'width:50px;width-max:60px', 'alt' => Yii::$app->params['proyecto']]); ?>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Iniciar sesion.</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['autocomplete' => 'off']]) ?>
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div class="row">

                        <div id="divLoginAdmin" class="small-box bg-gray-dark">
                            <div class="inner">
                                <h5>Login:</h5>
                                <?= $form->field($model,'username', [
                                    'options' => ['class' => 'form-group has-feedback','autocomplete' => 'off'],
                                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3']
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

                                <?= $form->field($model, 'password', [
                                    'options' => ['class' => 'form-group has-feedback','autocomplete' => 'off'],
                                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3']
                                ])
                                    ->label(false)
                                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                                <p class="d-flex align-items-center justify-content-center">
                                    <?= Html::submitButton('Iniciar', ['value' => 1,'name' => 'admin','class' => 'btn btn-light btn-block']) ?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
    <!-- /.login-card-body -->
    <div class=" h-100 d-flex align-items-center justify-content-center" >
        <?= Html::img('@web/img/empresa.png', ['style' => 'width:90%;width-max:200px', 'alt' => 'Logo Corporativo']); ?><br>
    </div>
<?php

if(!empty($notificacion)){
    $this->registerJs(
        " toastr.error('".trim($notificacion)."'); "
    );
}

$this->registerJsFile('@web/js/login.js');

?>