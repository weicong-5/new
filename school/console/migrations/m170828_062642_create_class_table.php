<?php

use yii\db\Migration;

/**
 * Handles the creation of table `class`.
 */
class m170828_062642_create_class_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="班级表"';
        }

        $this->createTable('{{%class}}', [
            'id' => $this->primaryKey(),
            'school_id' => $this->integer(11)->notNull()->comment('学校ID'),
            'grade' => $this->string(255)->notNull()->comment('年级'),
            'room' => $this->string(255)->notNull()->comment('班级'),
        ],$tableOptions);

//        $this->addForeignKey('fk_class_school','{{%class}}','school_id','{{%school}}','id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170828_062642_create_class_table cannot be reverted';
        $this->dropTable('{{%class}}');
        return false;
    }
}
