<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/8
 * Time: 9:47
 */
$this->title = '文章列表';

//面包屑导航
$this->params['breadcrumbs'][] = $this->title;

$session = Yii::$app->session;

if($session->isActive){
    $session->open();
}



?>


<h2>取出session中的post</h2>
<div>
    <?php
    if(isset($session['post'])){
        $post = unserialize($session->get('post'));
        echo $post->title;

    }
    ?>
</div>