<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TeacherStaff */

$this->title = '更改教师职工信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '所有教师职工', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-staff-update">

    <?= $this->render('_form', [
        'model' => $model,
        'staff_type' => $staff_type,
        'political_status' => $political_status,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
