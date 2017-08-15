<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\School */

$this->title = Yii::t('school', 'Update {modelClass}: ', [
    'modelClass' => 'School',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('school', 'Schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('school', 'Update');
?>
<div class="school-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
