<?php

use hail812\adminlte\widgets\Menu;
use yii\helpers\Html;

/* @var $assetDir Url */
$strUserName = (!empty(Yii::$app->user) && isset(Yii::$app->user) && isset(Yii::$app->user->identity) && isset(Yii::$app->user->identity->username)) ? Yii::$app->user->identity->username:null;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->getHomeUrl() ?>" class="brand-link">
        <?= Html::img('@web/img/logo.png', ['width' => '100%', 'width-max' => '200', 'alt' => 'IpCheck', 'class'=>'brand-image img-rounded elevation-3', 'style'=>'opacity: .8']); ?>
        <br>
    </a>
    <br>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php if(empty(Yii::$app->user) && isset(Yii::$app->user) && !empty(Yii::$app->user->identity)): ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?= Html::img('@web/img/user.png', ['width' => 160, 'alt' => 'User Image']); ?><br>
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $strUserName ?></a>
                </div>
            </div>
        <?php endif; ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo Menu::widget([
                'items' => [
                    [
                        'label' => Yii::t('app', 'Administrador'),
                        'icon' => 'tachometer-alt',
                        'items' => [
                            ['label' => Yii::t('app', 'Usuarios'), 'url' => ['user/index'], 'iconStyle' => 'far'],
                            ['label' => Yii::t('app', 'Tipo'), 'url' => ['tipo/index'], 'iconStyle' => 'far'],
                        ],
                        'visible' => ((int)Yii::$app->user->identity->perfiluser->id_perfil == 1)
                    ],
                    [
                        'label' => Yii::t('app', 'Reportes'),
                        'icon' => 'fa-solid fa-file-excel',
                        'items' => [
                            ['label' => Yii::t('app', 'Log'), 'url' => ['log/index'], 'iconStyle' => 'far'],
                        ],
                    ],
                    ['label' => Yii::t('app', 'MisConexiones'), 'icon' => 'fa-solid fa-key', 'url' => ['conexion/index']],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => YII_ENV_DEV],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => YII_DEBUG],
                ]
            ]);
            ?>
        </nav>
        <i class="fa-light fa-pen-to-square"></i>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>