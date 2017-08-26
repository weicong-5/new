<?php

/* @var $this \yii\web\View */
/* @var $content string */

use kartik\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('common','Blog'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuLeft = [
        ['label' => Yii::t('yii','Home'), 'url' => ['/site/index']],
//        ['label' => Yii::t('common','About'), 'url' => ['/site/about']],
//        ['label' => Yii::t('common','Contact'), 'url' => ['/site/contact']],
        ['label' => Yii::t('common','Article'), 'url' => ['/post/index']],
        ['label' => Yii::t('common','Article'), 'url' => ['/post/create']],
    ];
//    if (Yii::$app->user->isGuest) {
//        $menuRight[] = ['label' => Yii::t('common','Signup'), 'url' => ['/site/signup']];
//        $menuRight[] = ['label' => Yii::t('common','Login'), 'url' => ['/site/login']];
//    } else{
////        $menuRight[] = '<li>'
////            . Html::beginForm(['/site/logout'], 'post')
////            . Html::submitButton(
////                'Logout (' . Yii::$app->user->identity->username . ')',
////                ['class' => 'btn btn-link logout']
////            )
////            . Html::endForm()
////            . '</li>';
//        if(isset($this->params['current_user'])){
//            $menuRight[] = [
//                'label' => '<img src="'.Yii::$app->params['avatar']['small'].'" alt="'.$this->params['current_user']['username'].'">',
//                'linkOptions' => ['class' => 'avatar'],
//                'items' => [
//                    ['label' => '<i class="fa fa-sign-out"></i>退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
//                ],
//            ];
//        }else {
//            $menuRight[] = [
////                'label' => '<img src="' . Yii::$app->params['avatar']['small'] . '" alt="' . Yii::$app->params['username'] . '">',
//                'label' => '<img src="' . Yii::$app->params['avatar']['small'] .  '">',
////            'url' => ['/site/lagout'],
//                'linkOptions' => ['class' => 'avatar'],
////            'options' => ['class' => 'avator'],
//                //下来菜单
//                'items' => [
//                    ['label' => '<i class="fa fa-sign-out"></i>退出', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
//                ],
//            ];
//        }
//    }
//    if(isset($this->params['current_user'])){
//        $menuRight[] = [
//            'label' => '<img src="'.Yii::$app->params['avatar']['small'].'" alt="'.$this->params['current_user']['username'].'">',
//            'linkOptions' => ['class' => 'avatar'],
//            'items' => [
//                ['label' => '<i class="fa fa-sign-out"></i>退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
//            ],
//        ];
//    }else{
//        $menuRight[] = ['label' => Yii::t('common','Signup'), 'url' => ['/site/signup']];
//        $menuRight[] = ['label' => Yii::t('common','Login'), 'url' => ['/site/login']];
//    }

    if (Yii::$app->user->isGuest) {
        $menuRight[] = ['label' => Yii::t('common','Signup'), 'url' => ['/site/signup']];
        $menuRight[] = ['label' => Yii::t('common','Login'), 'url' => ['/site/login']];
    }else{
        $menuRight[] =[
            'label' => '<img src="'.Yii::$app->params['avatar']['small'].'" alt="'.Yii::$app->user->identity->username.'">',
//            'label' => '<img src="'.Yii::$app->params['avatar']['small'].'" alt="test">',
            'linkOptions' => ['class' => 'avatar'],
            'items' => [
                ['label'=>'消息 '. Html::badge('15'),'url' => ['#'],'linkOptions' => ['data-method' => 'get']],
                ['label' =>'<i class"fa fa-sign-out></i>退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
            ],
        ];
    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuLeft,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,//当设置为false时，label标签中的html就会将样式显示出来
        'items' => $menuRight,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
