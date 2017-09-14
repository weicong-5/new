<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\School */

$this->title = 'Create School';
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="school-create">

    <?= $this->render('_form', [
        'model' => $model,
        'area_data' => $area_data,
    ]) ?>

</div>
