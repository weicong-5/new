<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use \yii\bootstrap\Modal;
use \yii\helpers\Html;
use \common\models\Status;
use \yii\helpers\Url;

if(!Yii::$app->user->isGuest){
    $uid =  Yii::$app->user->identity->id;
    $username = Yii::$app->user->identity->username;


//    $status_list = \common\models\RelationUserStatus::getStatusByUser($uid);
    $status_list = Status::getStatusByUser($uid);
//    print_r($status_list);
//echo $form = \yii\widgets\ActiveForm::begin();
//echo  \yii\helpers\Html::dropDownList('select-status',null,ArrayHelper::map($data,''))
    $select_data = null;
    Modal::begin([
        'id' => 'select-modal',
        'header' => '<h4 class="modal-title">选择身份</h4>',
//        'footer' => '<a href="/site/index" class="btn btn-primary" id="sure">确定</a>',
        'footer' => '<a href="#" class="btn btn-primary" id="sure">确定</a>',
    ]);
    if($status_list){
//        Modal::begin([
//            'id' => 'select-modal',
//            'header' => '<h4 class="modal-title">选择身份</h4>',
//            'footer' => '<a href="#" class="btn btn-primary" id="sure">确定</a>'
//        ]);
        echo "<h3>欢迎您，{$username} </h3>";
//        echo "<h3>欢迎您，{$uid} </h3>";
        $select_data[]='--选择身份--';
        foreach($status_list as $item){
            $select_data[] = "{$item['status']}——{$item['name']}";
        }
        print_r($status_list);
    }else{
//        Modal::begin([
//            'id' => 'select-modal',
//            'header' => '<h4 class="modal-title">选择身份</h4>',
//            'footer' => '<a href="#" class="btn btn-primary disabled" data-dismiss="modal">确定</a>'
//        ]);
        echo "<h3>欢迎您，{$username} </h3>";
        echo "<h3>欢迎您，{$uid} </h3>";
        $select_data[] = '暂无身份，请与管理员联系';
    }
    echo \yii\helpers\Html::dropDownList('select_status',[],$select_data,['class'=>'form-control','id'=>'status_list']);
    $requestUrl = Url::toRoute("/site/index");
    $js=<<< JS
        $(document).on('click','#select',function(){
            $.get("{$requestUrl}",{},
                function(data){
                    $('.body-content').html(data);
                })
        });
JS;
    $this->registerJs($js);

    Modal::end();
}


?>
<div class="site-index">

    <div class="body-content">
        <?php
        if(!Yii::$app->user->isGuest){
            echo Html::a('select','#',[
                'id' => 'select',
                'data-toggle' => 'modal',// 注意是modal 不是model
                'data-target' => '#select-modal',
//                'class' => 'btn btn-success',
            'class' => 'btn',
            ]);
        }
        echo \yii\helpers\Html::a('学生专栏','/status/student-dir',[
            'class' => 'btn'
        ]).
            \yii\helpers\Html::a('教师专栏','/status/teacher-dir',[
                'class' => 'btn',
            ]).
            \yii\helpers\Html::a('插入成绩','/status/insert-score',[
                'class' => 'btn',
            ])
        ?>
    </div>


</div>
