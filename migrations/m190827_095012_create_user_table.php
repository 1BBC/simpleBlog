<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m190827_095012_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->unique(),
            'password' => $this->string(),
            'isAdmin' => $this->boolean()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
