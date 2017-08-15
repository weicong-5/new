<?php

use yii\db\Migration;

/**
 * Handles the creation for table `school_grade_table`.
 */
class m160613_030038_create_school_grade_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%school_grade}}', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(255)->notNull()->defaultValue(''),
            'school_area_id'    => $this->integer(11)->notNull()->defaultValue(0),
            'school_id'         => $this->integer(11)->notNull()->defaultValue(0),
            'dateline'          => $this->integer(11)->notNull()->defaultValue(0),
            'display_order'     => $this->smallInteger(5)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->addForeignKey('fk_school_grade', '{{%school_grade}}', 'school_id', '{{%school_school}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('school_grade_table');
    }
}
