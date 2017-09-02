<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/12
 * Time: 17:01
 */
use kartik\helpers\Enum;
use yii\bootstrap\Alert;

//echo '学生信息列表';
$session = Yii::$app->session;
$status = $session->get('status');
$user_id = $session->get('user_id');
$name = $session->get('name');


if(Enum::isEmpty($session->get('status'))){
    echo Alert::widget([
        'options'=> [
            'class'=>'alert-danger',
        ],
        'body'=>'请选择具体的学生身份<a class="btn btn-danger btn-xs" href="/site/index">确定</a>',
    ]);
}else{
?>

<div class="row">
    <div class="col-lg-12">
        <?php
        echo kartik\helpers\Html::jumbotron(
            "<h4>学生个人信息</h4>".
            "<table class='table table-hover'>
                    <tr>
                        <td>用户ID</td><td>{$user_id}</td>
                    </tr>
                    <tr>
                        <td>身份</td><td>{$status}</td>
                    </tr>
                    <tr>
                        <td>姓名</td><td>{$name}</td>
                    </tr>
                </table>"
        );
        ?>
    </div>
</div>
<?php
}
?>




