<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/6
 * Time: 15:39
 */
use common\models\TeacherStaff;
use common\models\Grade;

use kartik\helpers\Enum;
use yii\bootstrap\Alert;
use kartik\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;


$session = Yii::$app->session;
$status = $session->get('status');
$user_id = $session->get('user_id');
$name = $session->get('name');

$teacher_info = TeacherStaff::find()->where(['user_id'=>$user_id,'name'=>$name])->asArray()->one();
//$teacher_info['sex'] = $teacher_info['sex'] == 0?'男':'女';
//$teacher_info['office_room'] = Enum::isEmpty($teacher_info['office_room'])?'无':$teacher_info['office_room'];
//$teacher_info['office_phone'] = Enum::isEmpty($teacher_info['office_phone'])?'无':$teacher_info['office_phone'];

//根据职位确定范围
switch($teacher_info['staff_type']){
    case '校长':
        $query = Grade::find()->where(['school_name'=>$teacher_info['school_name']]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pagesize' => 10,
            ]
        ]);
        break;
    case '级长':
        break;
    case '班主任':
        $class_arr = unserialize($teacher_info['teach_class']);//所教的班级数组 如[201,202,203..]
        $teach_subject = $teacher_info['subject'];//所教科目
        $session->set('subject',$teach_subject);
//        $session->set('headteacher','yes');
        $query = Grade::find()->where(['school_name'=>$teacher_info['school_name'],'room'=>$class_arr]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        break;
    case '科任老师':
        $class_arr = unserialize($teacher_info['teach_class']);//所教的班级数组 如[201,202,203..]
        $teach_subject = $teacher_info['subject'];//所教科目
        $session->set('subject',$teach_subject);
        $query = Grade::find()->where(['school_name'=>$teacher_info['school_name'],'room'=>$class_arr]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        break;
}


if(Enum::isEmpty($status) || !in_array($status,TeacherStaff::getAllStaffType())){
    echo Alert::widget([
        'options'=> [
            'class'=>'alert-danger',
        ],
        'body'=>'请选择具体的教师职工身份<a class="btn btn-danger btn-xs" href="/site/index">确定</a>',
    ]);
}else{
    ?>

    <?php Pjax::begin(); ?>
    <?php
    echo Breadcrumbs::widget([
        'homeLink' => ['label'=>'首页','url'=>['site/index']],
        'itemTemplate' => '<li>{link}</li>',
        'links' => [
            '学生成绩',
        ]
    ]);
    ?>
    <h2>各年级各班</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'grade',
            'room',
            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{status/view} {status/delete}',
//                'buttons' => [
//                    'status/view' => function($url,$model,$key){
//                        $options = [
//                            'class' => 'btn btn-xs btn-primary',
//                            'title' => '查看',
//                            'aria-label' => '查看',
//                            'data-pjax'=>'1',
//                        ];
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,$options);
//                    },
//                    'status/delete' => function($url,$model,$key){
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
//                            'class' => 'btn btn-xs btn-danger',
//                            'title' => '删除',
//                            'aria-label' => '删除',
//                            'data-pjax'=>'1',
//                            'data' => [
//                                'confirm' => 'Are you sure you want to delete this item?',
//                                'method' => 'post',
//                            ]
//                        ]);
//                    },
//                ],
                'label' => '操作',
                'format'=>'raw',
                'value' => function($data){
                    $url = 'view-room?grade='.$data->grade.'&room='.$data->room.'&school='.$data->school_name;//少个学校参数
                    return Html::a('查看本班学生',$url,['title'=>'查看','class'=>'btn btn-primary']);
                }
            ],
        ],
        'layout'=>"{items}\n{pager}",
    ]);
                ?>
                <?php Pjax::end(); ?>
    <?php
}
?>