<?php
/**
 * @Copyright Copyright (c) 2016 @base.php By Kami
 * @License http://www.yuzhai.tv/
 */

use common\assets\AdminLteAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/* @var $this \yii\web\View */
/* @var $content string */

$bundle = AdminLteAsset::register($this);
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<?php echo Html::beginTag('body', [
    'class' => implode(' ', [
        ArrayHelper::getValue($this->params, 'body-class'),
        'hold-transition',
        'skin-blue',
        'sidebar-mini',
    ])
])?>
    <?php $this->beginBody() ?>
        <?= $content ?>
    <?php $this->endBody() ?>
<?php echo Html::endTag('body') ?>
</html>
<?php $this->endPage() ?>