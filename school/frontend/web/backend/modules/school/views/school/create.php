<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\School */

$this->title = Yii::t('school', 'Create School');
$this->params['breadcrumbs'][] = ['label' => Yii::t('school', 'Schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
