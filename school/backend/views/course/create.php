<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = 'Create Course';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <h1>课程设置</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
