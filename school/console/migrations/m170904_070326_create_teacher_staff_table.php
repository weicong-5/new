<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teacher_staff`.
 */
class m170904_070326_create_teacher_staff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName == 'mysql'){
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "教师职工表"';
        }

        $this->createTable('{{%teacher_staff}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull()->comment('用户ID'),
            'staff_type'=> $this->string(255)->notNull()->comment('职工类型'),
            'name' => $this->string(255)->notNull()->comment('姓名'),
            'sex'=> $this->smallInteger(8)->notNull()->defaultValue(1)->comment('性别 0表示男 1表示女'),
            'political_status' => $this->string(255)->notNull()->defaultValue('群众')->comment('政治面貌'),
            'tel'=>$this->string(11)->notNull()->comment('手机号码'),
            'school_id'=>$this->integer(11)->notNull()->comment('学校ID'),
            'school_name'=>$this->string(255)->notNull()->comment('学校名称'),
            'office_room' => $this->string(255)->comment('办公室'),
            'office_phone' => $this->string(11)->comment('办公电话'),
            'headteacher_grade' => $this->string(255)->defaultValue(null)->comment('任班主任所在年级'),
            'headteacher_class' => $this->string(255)->defaultValue(null)->comment('任班主任所在班级'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170904_070326_create_teacher_staff_table cannot be reverted';
        $this->dropTable('{{%teacher_staff}}');
        return false;
    }
}
