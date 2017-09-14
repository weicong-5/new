<?php


/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\School */

$this->title = Yii::t('school','Update {modelClass}: ') . $model->school_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('school','All schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('school','Update');
?>
<div class="school-update">

    <?= $this->render('_form', [
        'model' => $model,
        'areas' => $areas,
    ]) ?>

</div>
