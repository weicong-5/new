<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'summary',
            [
                'attribute'=>'content',
                'value'=>function($data){
                    $arr = unserialize($data->content);
                    return implode(" ",$arr);
                }
            ],
            'label_img',
            'cat_id',
            'user_id',
            'user_name',
            [
                'attribute'=>'is_valid',
                'value'=> function($data){
                    return $data->is_valid == 1?'是':'否';
                }
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
