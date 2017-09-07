<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Grade */

$this->title = '班级设置: ';
$this->params['breadcrumbs'][] = ['label' => '各学校各班级', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->school_name." ".$model->grade." ".$model->room, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
