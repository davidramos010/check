<?php
$strAddStyle = "margin-left: 0 !important;";
if (!empty(Yii::$app->user) && isset(Yii::$app->user) && !empty(Yii::$app->user->identity)):
    $strAddStyle = "";
endif;

?>
<footer class="main-footer" style="<?= $strAddStyle ?>">
    <strong>Copyright &copy; <?= date('Y') ?>.</strong>
    All rights reserved. <?= Yii::$app->params['proyecto'] ?><br>
    <a href = "mailto: <?= Yii::$app->params['email'] ?>"><?= Yii::$app->params['email'] ?></a>
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.1.0 PRO
    </div>
</footer>