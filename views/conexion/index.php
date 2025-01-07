<?php

use app\models\Conexion;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
/** @var yii\web\View $this */
/** @var app\models\ConexionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Conexiones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="ribbon_wrap" >
        <div class="row" style="padding: 5px 5px 5px 5px ">
            <div class="col-md-10"> </div>
            <div class="col-md-2">
                <div class="d-flex justify-content-end">
                    <?php
                    echo Html::a(Yii::t('app', 'Crear Conexión'),['create'],['class' => 'btn btn-success btn-md']);
                    echo " &nbsp;&nbsp; ";
                    echo Html::a(Yii::t('app', 'Check'),['check'],['class' => 'btn btn-warning btn-md']);
                    ?>
                </div>
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
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre',
                    'detalle',
                    [
                        'attribute' => 'tipo_id',
                        'label' => 'Tipo',
                        'headerOptions' => array('style' => 'width: 10%'),
                        'format' => 'raw',
                        'value' => function(Conexion $model){
                            return strtoupper($model->tipo->nombre);
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
                        'attribute' => 'estado',
                        'label' => 'Estado',
                        'headerOptions' => array('style' => 'width: 10%'),
                        'format' => 'raw',
                        'value' => function($model){
                            return ($model->estado==1)? '<span class="float-none badge bg-success">'.Yii::t('app', 'Activo' ).'</span>':'<span class="float-none badge bg-danger">'.Yii::t('app', 'Inactivo' ).'</span>' ;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => array('1' => 'ACTIVO', '0' => 'INACTIVO'),
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
                        'attribute' => 'created_at',
                        'label' => 'Creado',
                        'filter' => false,
                        'headerOptions' => array('style' => 'width: 10%'),
                        'format' => 'raw',
                        'value' => function($model){
                            $timestamp = strtotime($model->created_at);
                            return date('d/m/Y', $timestamp) ;
                        },
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update}',
                        'urlCreator' => function ($action, Conexion $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ]
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
                    'filename'        => Yii::t('app', 'ReportTipos'),
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