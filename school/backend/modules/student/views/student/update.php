<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\student\models\Student */

$this->title = '修改学生信息';
$this->params['breadcrumbs'][] = ['label' => '所有学生', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->student_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="student-update">

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
