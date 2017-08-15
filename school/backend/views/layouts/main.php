<?php
/**
 * @Copyright Copyright (c) 2016 @maim.php By Kami
 * @License http://www.yuzhai.tv/
 */
use common\widgets\Alert;
/**
 * @var $this yii\web\View
 */
?>

<?php $this->beginContent('@backend/views/layouts/common.php'); ?>
<div class="box">
    <div class="box-body">
        <?= Alert::widget(['class' => '']) ?>
        <?php echo $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
