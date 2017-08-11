<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/11
 * Time: 8:36
 * 测试页面
 */


if (isset($this->params['current_user'])){
   $string = '通过url传值';
}
?>
<div>
    <?=$string?>
    用户信息
    <p>ID:<?= $user_info['id'] ?></p>
    <p>Name:<?= $user_info['username'] ?></p>
    <p>Email<?= $user_info['email'] ?></p>
</div>
