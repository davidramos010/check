<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tipo $model */

$this->title = Yii::t('app', 'Create Tipo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
