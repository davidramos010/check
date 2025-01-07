<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Conexion $model */
/** @var array $arrHost */
/** @var array $arrApi */
/** @var array $arrBd */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Conexiónes Host</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6"
                     style="background-color: #1e1e1e; color: #00ff00; padding: 20px; font-family: monospace; border-radius: 5px;">
                    <div style="color: #1cc6e1">CheckList Host</div>
                    <?php foreach ($arrHost as $key => $line): ?>
                        <div>&gt;  <?= $key ?> - <?= ($line == 'KO')?'<label style="color: #9f1447">KO</label>':'OK' ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-6"
                     style="background-color: #1e1e1e; color: #00ff00; padding: 20px; font-family: monospace; border-radius: 5px;">
                    <div style="color: #1cc6e1">CheckList Apis</div>
                    <?php foreach ($arrApi as $key => $line): ?>
                        <div>&gt;  <?= $key ?> - <?= ($line == 'KO')?'<label style="color: #9f1447">KO</label>':'OK' ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-6"
                     style="background-color: #1e1e1e; color: #00ff00; padding: 20px; font-family: monospace; border-radius: 5px;">
                    <div style="color: #1cc6e1">CheckList DataBases</div>
                    <?php foreach ($arrBd as $key => $line): ?>
                        <div>&gt;  <?= $key ?> - <?= ($line == 'KO')?'<label style="color: #9f1447">KO</label>':'OK' ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>
