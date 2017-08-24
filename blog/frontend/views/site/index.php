<?php

/* @var $this yii\web\View */
use yii\widgets\Pjax;

$this->title = 'My Yii Application';

$script = <<< JS
$(document).ready(function(){
setInterval(function(){
$('#refreshButton').click();
},1000);
});
JS;
$this->registerJs($script);

$session = Yii::$app->session;

?>
<div class="site-index">

<!--    <div class="jumbotron">-->
<!--        <h1>Congratulations!</h1>-->
<!---->
<!--        <p class="lead">You have successfully created your Yii-powered application.</p>-->
<!---->
<!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
<!--    </div>-->

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <?php Pjax:: begin()?>
                <h2> CurrentTime:<bold><?= $time ?></bold></h2>
                <?= \yii\helpers\Html::a('refresh',['site/auto-refresh'],['class'=>'btn btn-primary hidden','id'=>'refreshButton'])?>
                <?php Pjax::end()?>
            </div>
            <div class="col-lg-4">
                <?php
                    if(!$session->isActive) {
                        $session->open();
                        $post = new \common\models\Posts();
                        $post->id = 5;
                        $post->title = '被偷走的那五年';
                        $post->content = '讲述一对情侣之间的爱情故事，因为车祸而让女主失去了五年的记忆';
                        $session->set('post',serialize($post));

                        unset($post);
                    }

                ?>
            </div>
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
<!--            </div>-->
        </div>

    </div>
</div>
