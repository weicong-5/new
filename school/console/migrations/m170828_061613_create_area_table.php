<?php

use yii\db\Migration;

/**
 * Handles the creation of table `area`.
 */
class m170828_061613_create_area_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="地区表"';
        }

        $this->createTable('{{%area}}', [
            'id' => $this->primaryKey(),
            'province_name' => $this->string(255)->notNull()->comment('省份名称'),
            'city_name' => $this->string(255)->notNull()->comment('城市名称'),
            'area_name' => $this->string(255)->notNull()->comment('区域名称'),
            'postcode' => $this->string(255)->comment('邮编'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170828_061613_create_area_table cannot be reverted';
        $this->dropTable('{{%area}}');
        return false;
    }
}
