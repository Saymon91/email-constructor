<?php

use yii\db\Migration;

/**
 * Handles the creation of table `templates`.
 */
class m181007_202329_create_templates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('templates', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'filename' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('templates');
    }
}
