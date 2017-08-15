<?php
/**
 * @Copyright Copyright (c) 2016 @uc.php By Kami
 * @License http://www.yuzhai.tv/
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">

    </div>

    <?= Html::a("Refresh", ['get-uc-list/get'], ['class' => 'btn btn-lg btn-primary', 'name' => 'refreshButton' ,'id' => 'refreshButton']);?>
    <h1>Current time: <?= $time ?></h1>
    <?= GridView::widget([
        'dataProvider' => $models,
        'columns' => [
            'uid',
            'username',
        ],
    ]); ?>

    <?php
    if (Yii::$app->request->get('page') < 3) {
        $page = Yii::$app->request->get('page') ? Yii::$app->request->get('page') + 1 : 1;
        $script = <<< JS
    jQuery(document).ready(function() {
        setTimeout("window.location.href = 'index.php?r=get-uc-list/get&page={$page}';", 4000);
    });
JS;
        $this->registerJs($script);
    }
    ?>
</div>
