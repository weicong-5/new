<?php



/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\School */

$this->title = Yii::t('school','Create School');
//$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-create">

    <?= $this->render('_form', [
        'model' => $model,
        'areas' => $areas,
    ]) ?>

</div>
