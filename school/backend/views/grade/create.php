<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Grade */

$this->title = '创建班级';
$this->params['breadcrumbs'][] = ['label' => '全部班级', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-create">

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools,
        'grades' => $grades,
    ]) ?>

</div>
