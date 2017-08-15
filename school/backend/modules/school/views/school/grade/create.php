<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\SchoolGrade */

$this->title = Yii::t('school', 'Create School Grade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('school', 'School Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
