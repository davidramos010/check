<?php

use app\models\Conexion;
use app\models\Log;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="ribbon_wrap" >
        <div class="row">
            <div class="col-md-10">
                <div class="ribbon_addon pull-right margin-r-5" style="margin-right: 3% !important">
                    <?php
                    echo Html::ul([
                        Yii::t('app', 'Este módulo solo esta habilitado para el administrador.'),
                    ], ['encode' => false]);
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="d-flex justify-content-end"></div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php Pjax::begin(); ?>
                <?php
                $gridColumns = [
                    [
                        'attribute' => 'tipo_id',
                        'label' => 'Tipo',
                        'format' => 'raw',
                        'headerOptions' => array('style' => 'width: 10%'),
                        'enableSorting'=>false,
                        'value' => function(Log $model){
                            return $model->conexion->tipo->nombre;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => Conexion::getTipoConexiones(),
                        'filterWidgetOptions' => array(
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'size' => Select2::SMALL,
                            'pluginOptions' => array(
                                'allowClear' => true,
                                'placeholder' => 'Todos',
                            )
                        ),
                    ],
                    [
                        'attribute' => 'nombre',
                        'label' => 'Conexión',
                        'format' => 'raw',
                        'headerOptions' => array('style' => 'width: 10%'),
                        'enableSorting'=>false,
                        'value' => function(Log $model){
                            return $model->conexion->nombre;
                        }
                    ],


                    [
                        'attribute' => 'peticion',
                        'label' => 'Petición',
                        'format' => 'raw',
                        'headerOptions' => array('style' => 'width: 15%'),
                    ],
                    [
                        'attribute' => 'respuesta',
                        'label' => 'Respuesta',
                        'format' => 'raw',
                        'headerOptions' => array('style' => 'width: 15%'),
                    ],
                    [
                        'attribute' => 'codigo',
                        'label' => 'Código',
                        'format' => 'raw',
                        'headerOptions' => array('style' => 'width: 15%'),
                    ],
                    [
                        'attribute' => 'user_id',
                        'label' => 'Usuario',
                        'format' => 'raw',
                        'headerOptions' => array('style' => 'width: 10%'),
                        'filter' => false,
                        'value' => function(Log $model){
                            return $model->user->username;
                        }
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Usuario',
                        'format' => 'raw',
                        'headerOptions' => array('style' => 'width: 10%'),
                        'filter' => false,
                        'value' => function(Log $model){
                            return $model->created_at;
                        }
                    ],

                ];
                ?>
                <?= // Renders a export dropdown menu
                ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'dropdownOptions' => [
                        'label' => 'Export All',
                        'class' => 'btn btn-default',
                    ],
                    'showConfirmAlert'=>false,
                    'exportContainer' => [
                        'class' => 'btn-group mr-2'
                    ],
                    'filename'        => Yii::t('app', 'ReportLog'),
                    'exportConfig' => [
                        ExportMenu::FORMAT_HTML => false,
                        ExportMenu::FORMAT_EXCEL => false,
                        ExportMenu::FORMAT_TEXT => false,
                        ExportMenu::FORMAT_PDF => false,
                        ExportMenu::FORMAT_CSV   => [
                            'label'           => Yii::t('app', 'CSV'),
                        ],
                        ExportMenu::FORMAT_EXCEL_X => [
                            'label'           => Yii::t('app', 'Excel'),
                        ],
                    ],
                ]);
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'summaryOptions' => ['class' => 'summary mb-2'],
                    'pager' => [
                        'class' => 'yii\bootstrap4\LinkPager',
                    ]
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
            </div>
        </div>
    </div>
</div>