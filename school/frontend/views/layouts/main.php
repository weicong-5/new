<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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
        'brandLabel' => '旭衍科技',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('frontend','Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('frontend','Student'), 'url' => ['/status/student-dir']],
        ['label' => Yii::t('frontend','Teacher'), 'url' => ['/status/teacher-dir']],
        ['label' => Yii::t('frontend','家长专栏'), 'url' => ['/status/#']],
//        ['label' => Yii::t('frontend','About'), 'url' => ['/site/about']],
//        ['label' => Yii::t('frontend','Contact'), 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => Yii::t('frontend','Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('frontend','Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[] =
            [
                'label' => yii::$app->user->identity->username,
                'items' => [
//                    ['label'=>'个人中心','url'=> ['/site/personalCenter'],'linkOptions' => ['data-method' => 'get']],
                    ['label'=>'个人中心','url'=> ['/site/personal']],
                    ['label' =>'退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],

                ],
            ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
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
        <p class="pull-left">&copy; 旭衍科技 <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
