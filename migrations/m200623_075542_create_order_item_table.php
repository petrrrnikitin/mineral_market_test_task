<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orderitem}}`.
 */
class m200623_075542_create_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'quantity' => $this->integer(),

        ]);

        $this->addForeignKey(
            'fk-order_item-order_id',
            'order_item',
            'order_id',
            'order',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-order_item-product_id',
            'order_item',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropForeignKey(
            'fk-order_item-product_id',
            'order_item'
        );
        $this->dropForeignKey(
            'fk-order_item-product_id',
            'order_item'
        );
    }
}
