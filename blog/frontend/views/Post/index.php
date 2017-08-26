<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/8
 * Time: 9:47
 */
$url = \yii\helpers\Url::to(['search-cat']);

use \kartik\helpers\Html;
use \kartik\helpers\Enum;
$this->title = '文章列表';

//面包屑导航
$this->params['breadcrumbs'][] = $this->title;

$session = Yii::$app->session;

if($session->isActive){
    $session->open();
}



?>


<!--<h2>取出session中的post</h2>-->
<div>
    <?php
    if(isset($session['post'])){
        $post = unserialize($session->get('post'));
        echo Html::well(
            "<h2>取出session中的post</h2>{$post->title}"
        );
//        echo $post->title;

    }

    echo Html::listGroup([
        [
            'content' => '文章类型1',
            'url' => '#',
            'badge' => '22',
            'active' => true,
        ],
        [
            'content' => '文章类型2',
            'url' => '#',
            'badge' => '11',
        ],
        [
            'content' => '文章类型3',
            'url' =>'#',
            'badge' => '5',
        ]
    ]);

    $body =  'Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.';
    echo Html::mediaList([
        [
        'heading'=>'Media heading 1',
        'body'=>$body,
        'src'=>'#',
        'img'=>'http://placehold.it/64x64',
        'items' => [
            [
            'heading'=>'Media heading 1-1',
            'body'=>$body,
            'src'=>'#',
            'img'=>'http://placehold.it/64x64',
            ],
            [
            'heading'=>'Media heading 1-2',
            'body'=>$body,
            'src'=>'#',
            'img'=>'http://placehold.it/64x64',
            ]
        ]
        ]
        ,
        [
            'heading'=>'Media heading 2',
            'body' => $body,
            'src' => '#',
            'img' => 'http://placehold.it/64x64',
        ]
    ]);


    echo Html::checkboxButtonGroup('categories',[1,3],[1=>'分类1',2=>'分类2',3=>'分类3',4=>'分类4',5=>'分类5']);

    echo Html::radioButtonGroup('level',2,[1=>'低',2=>'中',3=>'高']);
    //活动复选 单选按钮组 可以传入生成模型的属性一起使用
    //activeCheckboxButtonGroup  activeRadioButtonGroup
    $data = [
        ['id'=>1,'name'=>'John','birthday'=>'01-Jul-1976','commission'=>4,500.50],
        [2,'Scott','26-Feb-1980','1,300.40', true],
        [3, 'Mary', '1990-02-10', null, false],
        [4, 'Lisa', '17-Dec-1982', '-900.34', true]
    ];
    echo Enum::array2table($data);

    echo "<p class='lead'>你当前浏览器的信息</p>";
    echo Enum::array2table(Enum::getBrowser(),true);
    echo "IP地址：".Enum::userIP(false);
    ?>
    <div class="row">
        <div class="col-lg-4 col-sm-4">
            <?php
            $years = Enum::yearList('1990','2017',true,true);
            echo Html::dropDownList('years',[2010],$years,['class'=>'form-control']);
            ?>
        </div>
        <div class="col-lg-4 col-sm-4">
<!--            尝试select2下拉框带搜索功能    效果没出来-->
            <?php
//            echo \kartik\select2\Select2::widget([
            $form = \yii\bootstrap\ActiveForm::begin();
            echo $form->field($model,'cat_id')->widget(\kartik\select2\Select2::className(),[
                'name' => 'cats',
                'options' => ['placeholder'=>'请选择分类...'],
                'pluginOptions' => [
                    'placeholder' => 'search..',
                    'allowClear' => true,
                    'language' => [
                        'errorLoading' => new \yii\web\JsExpression("function(){return 'waiting...';}"),
                    ],
                    'ajax' => [
                        'url' => $url,
                        'dataType' => 'json',
                        'data' => new \yii\web\JsExpression('function(params){return {q:params.term};}'),
                    ],
                    'escapeMarkup' => new \yii\web\JsExpression('function(markup){return markup;}'),
                    'templateResult' => new \yii\web\JsExpression('function(res){return res.text;}'),
                    'templateSelection' => new \yii\web\JsExpression('function(res){return res.text;}'),

                ],
            ]);
            \yii\bootstrap\ActiveForm::end();
            ?>
        </div>
    </div>

</div>