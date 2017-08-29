<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\School */

$this->title = 'Create School';
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$area_data = \common\models\Area::getAll();
?>
<div class="school-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'area_data' => $area_data,
    ]) ?>

</div>
