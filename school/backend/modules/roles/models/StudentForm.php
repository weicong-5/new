<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/18
 * Time: 9:55
 */
namespace backend\Modules\roles\models;

use common\models\RelationUserStatus;
use common\models\Student;
use yii\base\Exception;
use yii\base\Model;
use yii\db\Query;

class StudentForm extends Model{
    public $id;
    public $name;
    public $student_num;
    public $sex;
    public $school_id;
    public $grade_id;
    public $class_id;

    public $_lastError= "";//错误信息

    //场景
    const SCENARIOS_CREATE = 'create';//创建
    const SCENARIOS_UPDATE = 'update';//更新

    //定义事件
    const EVENT_AFTER_CREATE = 'eventAfterCreate';//创建之后的事件

    public function rules(){
        return [
            [['id','name','student_num','sex','school_id','grade_id','class_id'],'required'],
            [['id','sex','school_id','grade_id'],'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_num' => '学号',
            'name' => '姓名',
            'sex' => '性别',
            'school_id' => '学校',
            'grade_id' => '年级',
            'class_id' => '班级',
        ];
    }

    //场景设置
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_CREATE => ['student_num','name','sex','school_id','grade_id','class_id'],
        ];
        return array_merge(parent::scenarios(),$scenarios);
    }

    /**
     * 根据表单数据创建学生身份是否成功
     * @param $uid
     * @return bool
     * @throws \yii\db\Exception
     */
    public function create($uid,$rid){
        //事务
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $model = new Student();
            $model->setAttributes($this->attributes);
            if(!$model->save()){
                throw new Exception('创建学生身份失败');
            }

            $this->id = $model->id;

            //调用事件
            $data = $model->getAttributes();
            $data['uid']=$uid;
            $data['rid']=$rid;
            $this->_eventAfterCreate($data);
            $transaction->commit();
            return true;
        }catch(Exception $e){
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }
    }

    /**
     * 创建学生身份之后事件集
     * @param $data
     */
    public function _eventAfterCreate($data){//相当于把创建身份后调用的事件集中起来
        $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventBindStatus'],$data);
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    /**
     * 将学生身份和用户绑定
     * @param $event
     * @return int
     * @throws Exception
     */
    public function _eventBindStatus($event){
        $relation = new RelationUserStatus();
        $relation->user_id = $event->data['uid'];
        $relation->status_id = $event->data['id'];
        $relation->role_id = $event->data['rid'];


        if(!$relation->save()){
            throw new Exception("保存用户身份关联关系失败");
        }
        return $relation->id;
    }
}