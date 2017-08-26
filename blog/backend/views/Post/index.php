<?php

//use yii\helpers\Html;
use yii\grid\GridView;
use \kartik\select2\Select2;
use \kartik\helpers\Html;

date_default_timezone_set('PRC');

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>

<!--    通过弹出层结合select2下拉菜单-->
        <?php
            \yii\bootstrap\Modal::begin([
                'options' => [
                    'id' => 'kartik-modal',
                    'tabindex' => false,
                ],
                'header' => '<h4 style="margin:0;padding:0">Select2 inside Modal</h4>',
                'toggleButton' => ['label'=>'Show Modal','class'=>'btn btn-primary'],
            ]);

            echo Select2::widget([
                'name' =>'select',//下拉菜单的name值
                'theme' => Select2::THEME_KRAJEE,//设置主题  分别有THEME_DEFAULT THEME_CLASSIC THEME_BOOTSTRAP
//                'size' => 'lg',//设置大小
                'toggleAllSettings' => [//多选的设置
                    'selectLabel' => '<i class="glyphicon glyphicon-ok-circle">Tag All</i>',
                    'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle">Untag All</i>',
                    'selectOptions' => ['class'=> 'text-success'],
                    'unselectOptions' => ['class'=>'text-danger']
                ],
                //输入框的插件
                'addon'=> [
                    'prepend' => [
                        'content' => Html::icon('globe'),
                    ],
                    'append' => [
                        'content' => Html::button(Html::icon('map-marker'),[
                           'class' => 'btn btn-primary',
                            'title' => '在地图上标记',
                            'data-toggle' => 'tooltip',
                        ]),
                        'asButton' => true,
                    ]
                ],
                'data' => [1=>'First',2=>'Second',3=>'Third',4=>'Fourth',5=>'Fifth'],
                'options' => [
                    'placeholder' => 'Select the th...',
                    'multiple' => true,//设置多选
                ],
//                'hideSearch' => true,//隐藏搜索
            ]);

            \yii\bootstrap\Modal::end();
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
//            'summary',
//            'content:ntext',
//            'label_img',
            // 'cat_id',
            // 'user_id',
            // 'user_name',
            // 'is_valid',
            // 'created_at',
             [
                 'attribute'=>'updated_at',
                 'format' => ['date','php:Y-m-d H:i:s']
             ],

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]); ?>
</div>
