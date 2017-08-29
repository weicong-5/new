<?php

use yii\db\Migration;

/**
 * Handles the creation of table `score`.
 */
class m170828_075500_create_score_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="成绩表"';
        }

        $this->createTable('score', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(11)->notNull()->comment('学生ID'),
            'score' => $this->string(255)->comment('个人成绩'),
            'times' => $this->smallInteger(8)->defaultValue(0)->comment('第几次成绩'),
        ],$tableOptions);

//        $this->addForeignKey('fk_score_student','{{%score}}','student_id','{{%student}}','id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170828_075500_create_score_table cannot be reverted';
        $this->dropTable('{{%score}}');
        return false;
    }
}
