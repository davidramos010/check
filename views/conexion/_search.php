<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ConexionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="conexion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'detalle') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'tipo_id') ?>

    <?php // echo $form->field($model, 'host') ?>

    <?php // echo $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'db') ?>

    <?php // echo $form->field($model, 'attributes') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
