<?php

use yii\db\Migration;

class m160319_070529_create_district_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%school_district}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->defaultValue(''),
            'level' => $this->smallInteger(4)->unsigned()->notNull()->defaultValue(0),
            'upid' => $this->integer(8)->defaultValue(0),
            'displayorder' => $this->smallInteger(6)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_school_district_upid_displayorder', '{{%school_district}}', ['upid', 'displayorder']);
    }

    public function down()
    {
        $this->dropIndex('idx_school_district_upid_displayorder');
        $this->dropTable('{{%school_district}}');
        return false;
    }
}
