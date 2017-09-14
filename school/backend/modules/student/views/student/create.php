<?php


/* @var $this yii\web\View */
/* @var $model backend\modules\student\models\Student */

$this->title = '创建学生身份';
$this->params['breadcrumbs'][] = ['label' => '所有学生', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <?= $this->render('_form', [
        'model' => $model,
        'schools'=>$schools,
        'grades'=>$grades,
    ]) ?>

</div>
