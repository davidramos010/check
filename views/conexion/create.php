<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Conexion $model */

$this->title = Yii::t('app', 'Create conexion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conexions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conexion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
