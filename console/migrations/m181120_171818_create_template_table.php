<?php

use yii\db\Migration;

/**
 * Handles the creation of table `template`.
 */
class m181120_171818_create_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('template', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'preview' => $this->string(),
            'code' => $this->text(),
            'file' => $this->string(),
            'enable' => $this->integer()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('template');
    }
}
