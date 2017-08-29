<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */
$userInfo = \common\models\User::find()->where(['id'=>$model->id])->one();

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="row">
        <div class="col-lg-6">
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
//                    'id',
                    'username',
                    'email:email',
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date','php:Y-m-d H:i:s']
                    ],
                    [
                        'attribute' => 'last_login_at',
                        'format' => ['date','php:Y-m-d H:i:s']
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($data){
                            return $data->status == 1?'有效':'无效';
                        }
                    ],
                    [
                        'attribute' => 'is_manager',
                        'value' => function($data){
                            return $data->is_manager == 1?'是':'否';
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <h4>用户身份</h4>
        </div>
    </div>

</div>
