<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>

<div class="content-wrapper" <?php if(!isset(Yii::$app->user->identity) || empty(Yii::$app->user->identity)): ?> style="margin-left: 0 !important;" <?php endif; ?> >
    <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">

                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content" >
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>