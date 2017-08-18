<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/18
 * Time: 9:55
 */
namespace backend\Modules\roles\models;

use common\models\Student;
use yii\base\Exception;
use yii\base\Model;

class StudentForm extends Model{
    public $id;
    public $name;
    public $student_num;
    public $sex;
    public $school_id;
    public $grade_id;
    public $class_id;

    public $_lastError= "";//错误信息

    public function rules(){
        return [
//            [['id','name','student_num','sex','school_id','grade_id','class_id'],'required'],
//            [['id','sex','school_id','grade_id'],'integer']
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

    public function create(){
        //事务
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $model = new Student();
            $model->setAttributes($this->attributes);
            if(!$model->save()){
                throw new Exception('创建学生身份失败');
            }

            $this->id = $model->id;
            $transaction->commit();
            return true;
        }catch(Exception $e){
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }
    }
}