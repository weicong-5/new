<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/16
 * Time: 17:09
 */
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use \common\models\User;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;

$query = User::find()->where(['is_manager'=>0]);//查询所有用户

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => ['pagesize' => 10]
]);

?>

<h1><?= '用户列表' ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'email',
        ['attribute' => 'created_at',//指明函数作用的属性
        'value' => function($data){
            return date('Y-m-d H:i:s',$data->created_at);
        }],
        //操作
        [
//            'class' => 'yii\grid\CheckboxColumn', //复选框
//            '操作',
            'class' => 'yii\grid\ActionColumn',

        ],
    ],
    //当没有用户的时候显示
    'emptyText' => '当前没有用户',
    'emptyTextOptions' => ['style'=>'font-weight:bold'],
    'showOnEmpty' => false,//当数据不存在的时候，表格是否出现

])?>