<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\grade\models\Grade */

$this->title = Yii::t('school','Update Grade:') . $model->school_name.$model->grade.$model->room;
$this->params['breadcrumbs'][] = ['label' => Yii::t('school','All Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->school_name.$model->grade.$model->room, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-update">

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
