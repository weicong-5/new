<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_store`.
 */
class m170210_075849_create_shop_store_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('shop_store', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->defaultValue(''),
            'description' => $this->text()->notNull(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'recommend' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'address' => $this->string(255)->notNull()->defaultValue(''),
            '',
            'created_time' => $this->integer(10)->defaultValue(0),
            'updated_time' => $this->integer(10)->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('shop_store');
    }
}
