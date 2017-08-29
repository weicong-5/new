<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student`.
 */
class m170828_005059_create_student_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="学生表"';
        }

        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer(11)->notNull()->comment('用户ID'),
            'student_no' => $this->integer(11)->notNull()->comment('学生学号'),
            'school_id'=>$this->integer(11)->notNull()->comment('学校ID'),
            'student_name' => $this->string(255)->notNull()->comment('学生姓名'),
            'sex' => $this->smallInteger(8)->defaultValue(0)->comment('性别'),
            'grade'=> $this->string(255)->notNull()->comment('年级'),
            'class_id'=>$this->integer(11)->notNull()->comment('班级ID'),
            'class_position'=>$this->string(255)->defaultValue('')->comment('班级职务'),
            'course_id'=> $this->integer(11)->notNull()->comment('课程ID'),
            'score_id'=>$this->integer(11)->comment('成绩ID'),
        ],$tableOptions);

//        $this->createIndex('student_student_no','{{%student}}','student_no',true);

//        $this->addForeignKey('fk_student_user','{{%student}}','user_id','{{%user}}','id','CASCADE','RESTRICT');
//        $this->addForeignKey('fk_student_school','{{%student}}','school_id','{{%school}}','id','CASCADE','RESTRICT');
//        $this->addForeignKey('fk_student_class','{{%student}}','class_id','{{%class}}','id','CASCADE','RESTRICT');
//        $this->addForeignKey('fk_student_score','{{%student}}','score_id','{{%score}}','id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170828_005059_create_student_table cannot be reverted';
        $this->dropTable('{{%student}}');
        return false;
    }
}
