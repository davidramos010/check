<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

/** @var yii\web\View $this */
/** @var app\models\Tipo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tipo-form col-md-9">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tipo Enlace</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php $form = ActiveForm::begin(['id' => 'formTipo']); ?>
        <?= $form->field($model, 'id')->hiddenInput(['id' => 'id'])->label(false); ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'nombre')->textInput(['id' => 'nombre', 'maxlength' => true, 'class' => 'form-control', 'autocomplete' => 'off'])->label('*Nombre') ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'detalle')->textInput(['maxlength' => true, 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'text-transform: uppercase'])->label('Detalle') ?>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'estado')->widget(SwitchInput::class, ['pluginOptions' => ['size' => 'small', 'onText' => 'Activo', 'offText' => 'Inactivo']])->label('Estado'); ?>
                </div>
            </div>
            <div style="padding-top: 15px" >
                <?= Html::submitButton(Yii::t('yii', 'Guardar'), [ 'class' => 'btn btn-primary' ]); ?>
                <?= Html::a(Yii::t('app', 'Cancelar'), ['index'], ['class' => 'btn btn-default ']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
