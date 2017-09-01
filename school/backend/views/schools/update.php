<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\School */

$this->title = 'Update School: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="school-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'area_data' => $area_data,
    ]) ?>

</div>
