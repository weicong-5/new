<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/4
 * Time: 11:09
 */

use \yii\bootstrap\Modal;
use \common\models\Status;
use \kartik\helpers\Html;

$session = Yii::$app->session;

$selectIndex = $session->has('selectIndex')?$session->get('selectIndex'):[];

if(!Yii::$app->user->isGuest){//如果用户登录了获取用户id和username
    $uid =  Yii::$app->user->identity->id;
    $username = Yii::$app->user->identity->username;


    $status_list = Status::getStatusByUser($uid);
    $select_data = null;
    Modal::begin([
        'id' => 'select-modal',
        'header' => '<h4 class="modal-title">选择身份</h4>',
        'footer' => '<a href="#" id="sure" class="btn btn-primary" data-dismiss="modal">确定</a>',
    ]);
    if($status_list){
        echo "<h3>欢迎您，{$username} </h3>";
        $select_data[]='--选择身份--';
        foreach($status_list as $item){
            $select_data[] = "{$item['status']}——{$item['name']}";
        }
    }else{
        echo "<h3>欢迎您，{$username} </h3>";
        echo "<h3>欢迎您，{$uid} </h3>";
        $select_data[] = '暂无身份，请与管理员联系';
    }
    echo Html::dropDownList('select_status',$selectIndex,$select_data,['class'=>'form-control','id'=>'status_list','data'=>$status_list]);
    $js=<<< JS
       $(document).ready(function(){
        var status = null,user_id = null,student_name=null;
        var status_list = $('#status_list');
        status_list.bind('change',function(){
            var selected = $('#status_list option:selected');
            selectIndex = selected.val();
            if($(this).val() == 0){
                $('#sure').removeAttr('data-dismiss');//如果没选择 则弹窗关不了 只能点右上角X 关闭
            }else{
                $('#sure').attr('data-dismiss','modal');//有选择则点击确定可以关闭弹窗
                var item = $('#status_list').data()[selected.val()-1];
                status = item['status'],user_id = item['user_id'],student_name = item['name'];
                console.log(status+" "+user_id+" "+student_name+" "+selectIndex);
            }
        });
        $('#sure').bind('click',function(){
            var selected = $('#status_list option:selected');
            if(selected.val() == 0){
                $('#sure').removeAttr('data-dismiss');
            }
            $.ajax({
                    url:"/site/choose", //在site控制器中的choose动作 将提交的数据存到session中
                    data:{status:status,user_id:user_id,name:student_name,selectIndex:selectIndex},//是一个对象，连同请求一起发送到服务器的数据
                    dataType:"json",//预期服务器返回的数据类型
                    type:"post",
                });
        });
       });
JS;
    $this->registerJs($js);

    Modal::end();

}


?>
<?php $this->beginContent('@frontend/views/layouts/main.php'); ?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <?php
                if(!Yii::$app->user->isGuest):
                ?>
                    <a href="#" class="list-group-item" id="select" data-toggle="modal" data-target="#select-modal"><i class="glyphicon glyphicon-random pull-right"></i>切换身份</a>
                <?php endif;?>
                <a href="/site/eat" class="list-group-item"><i class="glyphicon glyphicon-cutlery pull-right"></i>吃</a>
                <a href="#" class="list-group-item"><i class="glyphicon glyphicon-glass pull-right"></i>喝</a>
                <a href="#" class="list-group-item">玩</a>
                <a href="#" class="list-group-item">乐</a>
                <a href="#" class="list-group-item">购物优惠</a>
            </div>
            <div class="col-lg-9">
                <?=$content?>
            </div>
        </div>
<!--        --><?php
//        if(!Yii::$app->user->isGuest){
//            echo Html::a('select','#',[
//                'id' => 'select',
//                'data-toggle' => 'modal',// 注意是modal 不是model
//                'data-target' => '#select-modal',
////                'class' => 'btn btn-success',
//                'class' => 'btn',
//            ]);
//        }
////        echo \yii\helpers\Html::a('学生专栏','/status/student-dir',[
////                'class' => 'btn'
////            ]).
////            \yii\helpers\Html::a('教师专栏','/status/teacher-dir',[
////                'class' => 'btn',
////            ]).
////            \yii\helpers\Html::a('插入成绩','/status/insert-score',[
////                'class' => 'btn',
////            ])
////        ?>
    </div>


</div>
<?php $this->endContent(); ?>