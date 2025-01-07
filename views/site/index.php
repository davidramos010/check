<?php

use hail812\adminlte\widgets\Callout;
use hail812\adminlte\widgets\InfoBox;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Dashboard';
$this->registerJsFile('@web/js/home.js');
$this->registerJsFile('@web/js/llave.js');

/** @var array $params */

?>
<div class="pull-right">


    <div class="col-md-12 card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= Yii::t('app', 'Última ejecución') ?></h3>
        </div>
        <div class="card-body">
            <div class="card card-primary">
                <div class="row">
                    <div class="col-md-6"
                         style="background-color: #1e1e1e; color: #00ff00; padding: 20px; font-family: monospace; border-radius: 5px;">
                        <div style="color: #1cc6e1">CheckList Data</div>
                        <?php foreach ($params as $dataLog): ?>
                            <div>
                                &gt; <?= ($dataLog->respuesta == 'KO') ? '<label style="color: #9f1447">KO</label>' : 'OK' ?>
                                - <?= $dataLog->tipo_nombre ?> - <?= $dataLog->conexion_nombre ?> || <label
                                        style="color: #fff"><?= $dataLog->peticion ?></label></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

</div>

