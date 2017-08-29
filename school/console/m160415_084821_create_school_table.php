<?php

use yii\db\Migration;

class m160415_084821_create_school_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%school_school}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(255)->notNull()->defaultValue(''),
            'province_id'   => $this->integer(11)->notNull()->defaultValue(0),
            //'province_id'   => $this->integer(11)->notNull()->defaultValue(0),
            'city_id'       => $this->integer(11)->notNull()->defaultValue(0),
            'area_id'       => $this->integer(11)->notNull()->defaultValue(0),
            'address'       => $this->string(255)->notNull()->defaultValue(''),
            'school_type'   => $this->string(255)->notNull()->defaultValue(1),
            'school_num'    => $this->string(255)->notNull()->defaultValue(0),
            'manage_uid'    => $this->smallInteger(8)->notNull()->defaultValue(0),
            'quantong_id'   => $this->integer(11)->unsigned()->notNull()->defaultValue(0),
            'number'        =>$this->text()->notNull(),
            'deny_code'     => $this->text()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_district_school', '{{%school_school}}', 'province_id', '{{%school_district}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        echo "m160415_084821_create_school_table cannot be reverted.\n";
        $this->dropTable('{{%school_school}}');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
