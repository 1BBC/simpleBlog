<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m190827_095113_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->defaultValue(1),
            'title' => $this->string(),
            'body' => $this->text(),
            'image' => $this->string(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-article-user_id',
            'article',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-article-user_id',
            'article',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-article-category_id',
            'article',
            'user_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-article-category_id',
            'article',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');
    }
}
