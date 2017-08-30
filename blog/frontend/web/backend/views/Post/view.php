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
//            'content:ntext',
            [
                'attribute'=>'content',
                'value'=>function($data){
                    return unserialize($data->content);
                }
            ],
            'label_img',
            'cat_id',
            'user_id',
            'user_name',
            'is_valid',
            [
                'attribute' => 'created_at',
                'value' => function($data){
                    return date($data->created_at);
                }
            ],
            'updated_at',
        ],
    ]) ?>

</div>
