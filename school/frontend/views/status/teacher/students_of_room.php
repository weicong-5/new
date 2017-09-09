<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/6
 * Time: 17:40
 */
use common\models\Student;

use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\helpers\Html;
use yii\widgets\Breadcrumbs;

//echo $grade."   ".$room."   ".$school;
$query = Student::find()->where(['grade'=>$grade,'class_name'=>$room,'school_name'=>$school]);
//$dataProvider = new ActiveDataProvider([
//    'query' => $query,
//    'pagination' => [
//        'pagesize' => 10,
//    ],
////    'sort'=> [
////        'defaultOrder' => [
////
////        ],
////    ]
//]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);
?>
<?php Pjax::begin(); ?>
    <?php
    echo Breadcrumbs::widget([
        'homeLink' => ['label'=>'首页','url'=>['site/index']],
        'itemTemplate' => '<li>{link}</li>',
        'links' => [
            [
                'label' => '学生成绩',
                'url' => ['teacher-modify-score'],
            ],
            '本班学生列表',
        ]
    ]);
    ?>
    <h2>本班学生列表</h2>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'student_no',
        'student_name',
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
//                $url = 'view-room?grade='.$data->grade.'&room='.$data->room.'&school='.$data->school_name;//少个学校参数
                $url = '/score/index?sid='.$data->id;
                $url2= '/score/create?sid='.$data->id;
                return Html::a('查看成绩',$url,['title'=>'查看','class'=>'btn btn-primary btn-xs'])." ".
                    Html::a('插入成绩',$url2,['class'=>'btn btn-danger btn-xs']);
            }
        ],
    ],
    'layout'=>"{items}\n{pager}",
]);
                ?>
                <?php Pjax::end(); ?>

