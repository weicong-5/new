<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\grade\models\Grade */

$this->title = Yii::t('school','Create Grade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('school','All Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-create">
    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
