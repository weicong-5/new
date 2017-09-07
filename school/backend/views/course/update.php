<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = '课程设置: ';
$this->params['breadcrumbs'][] = ['label' => '各年级班级', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->school_name." ".$model->grade , 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-update">

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
