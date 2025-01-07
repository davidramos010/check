<?php

use app\models\Conexion;
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Conexion $model */
/** @var yii\widgets\ActiveForm $form */

// Incluir el archivo JavaScript
$this->registerJsFile(Url::to('@web/js/conexion.js'), ['depends' => [\yii\web\JqueryAsset::class]]);

?>

<div class="tipo-form col-md-9">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Conexión</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php $form = ActiveForm::begin(['id' => 'formConexion']); ?>
        <?= $form->field($model, 'id')->hiddenInput(['id' => 'id'])->label(false); ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'tipo_id')->dropDownList(Conexion::getTipoConexiones(), ['id'=>'intTipoId', 'class' => 'form-control', 'prompt' => 'Seleccione Uno'])->label('Tipo Conexión'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'nombre')->textInput(['id' => 'strNombre', 'maxlength' => true, 'class' => 'form-control', 'autocomplete' => 'off'])->label('*Nombre') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'estado')->widget(SwitchInput::class, ['id'=>'intEstado','pluginOptions' => ['size' => 'small', 'onText' => 'Activo', 'offText' => 'Inactivo']])->label('Estado'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" id="field-host">
                    <?= $form->field($model, 'host')->textInput(['id'=>'strHost']) ?>
                </div>
                <div class="col-md-3" id="field-bd">
                    <?= $form->field($model, 'db')->textInput(['id'=>'strDb']) ?>
                </div>
                <div class="col-md-3" id="field-user">
                    <?= $form->field($model, 'user')->textInput(['id'=>'strUser']) ?>
                </div>
                <div class="col-md-3" id="field-password">
                    <?= $form->field($model, 'password')->textInput(['id'=>'strPassword']) ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'detalle')->textInput(['maxlength' => true, 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'text-transform: uppercase'])->label('Descripción') ?>
            </div>
            <div class="form-group">
                    <?= $form->field($model, 'attributes')->textInput() ?>
            </div>

            <div style="padding-top: 15px" >
                <?= Html::submitButton(Yii::t('yii', 'Guardar'), [ 'class' => 'btn btn-primary' ]); ?>
                <?= Html::a(Yii::t('app', 'Cancelar'), ['index'], ['class' => 'btn btn-default ']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
