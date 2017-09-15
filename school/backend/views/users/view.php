<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\grid\GridView;

use common\models\Profile;

/* @var $this yii\web\View */
/* @var $model common\models\User */
$userInfo = \common\models\User::find()->where(['id'=>$model->id])->one();

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '所有用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="row">
        <div class="col-lg-6">
            <p>
               <h4>用户信息</h4>
            </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
//                    'username',
                    'email:email',
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date','php:Y-m-d H:i:s']
                    ],
                    [
                        'attribute' => 'last_login_at',
                        'format' => ['date','php:Y-m-d H:i:s']
                    ],
                    [
                        'attribute' => 'active',
                        'value' => function($data){
                            return $data->active == 1?'有效':'无效';
                        }
                    ],
                    [
                        'attribute' => 'is_manager',
                        'value' => function($data){
                            return $data->is_manager == 1?'是':'否';
                        }
                    ],
                    [
                        'attribute' => '性别',
                        'value' => function($model){
                            return $model->profile['sex']=='0'?'男':'女';
                        }
                    ],
                    [
                        'attribute' => '政治面貌',
                        'value' => function($model){
                            return $model->profile['political_status'];
                        }
                    ],
                    [
                        'attribute' => '手机号码',
                        'value' => function($model){
                            return $model->profile['phone'];
                        }
                    ],
                ],
            ]) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?php
            Modal::begin([
                'id' => 'select-modal',
                'header' => '<h4 class="modal-title">选择身份</h4>',
                'footer' => Html::a('确定','#',['id'=>'sure','class'=>'btn btn-primary',])
            ]);
            //这里的身份选择数组 可以到时候在用户身份活动对象中定义 以后修改就一个地方修改即可

            echo \yii\helpers\Html::dropDownList('select_status',[],$status_list,['id'=>'select_list','class'=>'form-control']);
            echo \yii\helpers\Html::textInput('test',null,['id'=>'test']);
            Modal::end();
            ?>
            <h4>用户身份</h4>
            <?php
            print_r($model->status);
            echo \yii\helpers\Html::a('create','#',[
            'data-toggle' => 'modal',// 注意是modal 不是model
            'data-target' => '#select-modal',
            'class' => 'btn btn-success',
            ]);
            ?>
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'status',
                        'name',
                        'school',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{status/view} {status/delete}',
                            'buttons' => [
                                'status/view' => function($url,$model,$key){
                                    $options = [
                                        'class' => 'btn btn-xs btn-primary',
                                        'title' => '查看',
                                        'aria-label' => '查看',
                                        'data-pjax'=>'1',
                                    ];
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,$options);
                                },
                                'status/delete' => function($url,$model,$key){
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                        'class' => 'btn btn-xs btn-danger',
                                        'title' => '删除',
                                        'aria-label' => '删除',
                                        'data-pjax'=>'1',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ]
                                    ]);
                                },
                            ],
                        ],
                    ],
                    'layout'=>"{items}\n{pager}",
                ]);
                ?>
                <?php Pjax::end(); ?>

        </div>
    </div>

</div>

<?php
$script = <<< JS
//选择创建的身份不同 跳转到不同的创建身份页  控制器不同
$(document).ready(function(){
    var select_list = $('#select_list');
    var test_text = $('#test');
    var sure_button = $('#sure');
    select_list.bind('change',function(){
        var selected = $('#select_list option:selected');
        if($(this).val() == 0){
            return;
        }else{
            test_text.val(selected.val());
            sure_button.attr('href','/'+selected.val()+'/'+selected.val()+'/create?user_id='+$model->id+'&status='+selected.text());
            //比如选择创建学生身份则 url变成/student/create?user_id=传入的ID和status=身份
        }
    });
});
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);

?>
