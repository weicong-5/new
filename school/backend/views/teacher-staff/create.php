<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\TeacherStaff */

$this->title = '创建教师职工身份';
$this->params['breadcrumbs'][] = ['label' => '所有教师职工', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="teacher-staff-create">



    <?= $this->render('_form', [
        'model' => $model,
        'staff_type' => $staff_type,
        'political_status' => $political_status,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
