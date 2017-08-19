<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/17
 * Time: 9:18
 */
$userInfo = \common\models\User::find()->where(['id'=>$id])->one();
?>
<div>
    <h1>用户详情</h1>
</div>
<!--<div class="table-responsive">-->
<!--    <table class="table table-bordered">-->
<!--        <thead>-->
<!--            <tr>-->
<!--                <th>用户</th>-->
<!--                <th>操作</th>-->
<!--            </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--            <tr></tr>-->
<!--        </tbody>-->
<!--    </table>-->
<!--</div>-->
<div>
    用户名：<?=$userInfo['username']?><br>
    Email：<?=$userInfo['email']?><br>
    用户身份：<?=\yii\helpers\Html::a('添加身份','/role/status/select/?uid='.$id,['class'=>'btn btn-success pull-right'])?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>角色</th>
                    <th>姓名</th>
                    <th>学校</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <!--循环输出该用户所有身份-->
                <?php
                $statusList = \common\models\RelationUserStatus::getStatusByUser($id);
                if(!$statusList){
                   echo "<tr>
                            <td colspan='2'>暂无数据</td></tr>";
                }else{
//                    print_r($statusList);
                    foreach($statusList as $list){
//                        print_r($list);
                        $id = $list['id'];
                        $status_id = $list['status_id'];
                        $role_id = $list['role_id'];
//                        exit;
                        $role_name = \backend\Modules\roles\models\Roles::getRoleNameById($role_id);
                        //根据角色不同 从不同身份表中获取数据
                        $role = \backend\Modules\roles\models\Roles::switchRole($role_id);
                        $name = $role::getAttributeById('name',$status_id);
                        $school_id = $role::getAttributeById('school_id',$status_id);
                        $school_name = \common\models\School::getSchoolNameById($school_id);
                        echo "<tr><td>".$id."</td><td>".$role_name."</td><td>".$name."</td><td>".$school_name."</td><td>编辑||删除</td></tr>";
                    }
                }?>
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>