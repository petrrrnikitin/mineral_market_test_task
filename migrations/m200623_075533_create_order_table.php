<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m200623_075533_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->string(),
            'comment' => $this->text(),
            'email' => $this->string(),
            'phone' => $this->integer(),
            'status_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),

        ]);

        $this->addForeignKey(
            'fk-order-status_id',
            'order',
            'status_id',
            'status',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
        $this->dropForeignKey(
            'fk-order-status_id',
            'order'
        );
    }
}
