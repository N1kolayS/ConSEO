<?php

use yii\db\Migration;

/**
 * Handles the creation of table `config`.
 */
class m181209_165731_create_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(),
            'description' => $this->string(),
            'role' => $this->string(),
            'value' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('config');
    }
}
