<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('school', 'District');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Yii::t('school', 'Set District') ?></h1>

<p>
    <?= Html::a(Yii::t('school', 'Set District'), ['create'], ['class' => 'btn btn-primary']) ?>
</p>
