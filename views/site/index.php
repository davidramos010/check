<?php

use hail812\adminlte\widgets\Callout;
use hail812\adminlte\widgets\InfoBox;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Dashboard';
$this->registerJsFile('@web/js/home.js');
$this->registerJsFile('@web/js/llave.js');

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $params array */

$gridColumns = [
    [
        'attribute' => 'id_llave',
        'label' => 'Código',
        'headerOptions' => ['style' => 'width: 5%; '],
        'format' => 'raw',
        'enableSorting' => false,
        'value' => function($model){
            return '<button type="button" class="btn btn-outline-info btn-block btn-sm" data-toggle="modal" data-target="#modal-default" onclick="getInfoLlaveCard('.$model->id_llave.')">'.$model->llave->codigo.'</button>';
        }
    ],
    [
        'attribute' => 'id_llave',
        'label' => 'Descripción',
        'headerOptions' => ['style' => 'width: 15%'],
        'format' => 'raw',
        'enableSorting' => false,
        'value' => function($model){
            return isset($model->llave)?$model->llave->descripcion:'NA';
        }
    ],
    [
        'attribute' => 'id_llave',
        'label' => 'Cliente',
        'headerOptions' => ['style' => 'width: 15%'],
        'format' => 'raw',
        'enableSorting' => false,
        'value' => function($model){
            return (isset($model->llave->comunidad) && !empty($model->llave->comunidad))?$model->llave->comunidad->nombre:'';
        }
    ],
    [
        'attribute' => 'id_llave',
        'label' => 'Dirección',
        'headerOptions' => ['style' => 'width: 20%'],
        'format' => 'raw',
        'enableSorting' => false,
        'value' => function($model){
            return (isset($model->llave->comunidad) && !empty($model->llave->comunidad))?$model->llave->comunidad->poblacion.' '.$model->llave->comunidad->direccion:'';
        }
    ],
    [
        'attribute' => 'id_llave',
        'label' => 'Responsable',
        'headerOptions' => ['style' => 'width: 15%'],
        'format' => 'raw',
        'enableSorting' => false,
        'value' => function($model){
            return (isset($model->registro->comerciales) && !empty($model->registro->comerciales))?$model->registro->comerciales->nombre:'';
        }
    ],
    [
        'attribute' => 'id_llave',
        'label' => 'Teléfono',
        'headerOptions' => ['style' => 'width: 15%'],
        'format' => 'raw',
        'enableSorting' => false,
        'value' => function($model){
            return (isset($model->registro->comerciales) && !empty($model->registro->comerciales))?$model->registro->comerciales->telefono.' '.$model->registro->comerciales->movil:'';
        }
    ],
    [
        'attribute' => 'fecha',
        'label' => 'Fecha Salida',
        'headerOptions' => ['style' => 'width: 15%'],
        'format' => 'raw',
        'enableSorting' => false,
        'value' => function($model){
            return $model->fecha ;
        }
    ],
];

?>
<div class="pull-right" >



    <div class="row">
        <div class="col-md-3">
            <?= InfoBox::widget([
                'text' => Yii::t('app', 'Cant. Llaves'),
                'number' => 1 ,
                'theme' => 'gradient-success',
                'icon' => 'fas fa-key',
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'text' => Yii::t('app', 'Llaves por fuera'),
                'number' => 2,
                'theme' => 'gradient-info',
                'icon' => 'fas fa-key',
            ]) ?>
        </div>
        <div class="col-md-6 ">
            <?php $numPorcentaje = 3; ?>
            <?= InfoBox::widget([
                'text' => '<div class="progress">
                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="'.$numPorcentaje.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$numPorcentaje.'%">
                                 <span class="sr-only">'.$numPorcentaje.' '.Yii::t('app', 'indexLlavesFuera').'</span>
                                </div>
                              </div>
                              ',
                'number' => '<small>
                               22 '.Yii::t('app', 'indexLlavesFuera').'
                              </small>',
                'theme' => 'gradient-default',
                'icon' => 'fas fa-sign-out-alt',
            ]) ?>
        </div>
    </div>

    <div class="col-md-12 card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= Yii::t('app', 'indexTituloCliente') ?></h3>
        </div>
        <div class="card-body">

        </div>
        <!-- /.card-body -->
    </div>

    <div class="col-md-12 card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= Yii::t('app', 'indexTituloPropietario') ?></h3>
        </div>
        <div class="card-body">

        </div>
        <!-- /.card-body -->
    </div>
</div>

