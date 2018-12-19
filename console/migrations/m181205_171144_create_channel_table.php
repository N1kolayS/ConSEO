<?php

use yii\db\Migration;

/**
 * Handles the creation of table `channel`.
 * Has foreign keys to the tables:
 *
 * - `project`
 */
class m181205_171144_create_channel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('channel', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
            'title' => $this->string(),
            'phone' => $this->string(),
            'default' => $this->integer(),
            'enable' => $this->integer()->defaultValue(1),
        ]);

        // creates index for column `project_id`
        $this->createIndex(
            'idx-channel-project_id',
            'channel',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-channel-project_id',
            'channel',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `project`
        $this->dropForeignKey(
            'fk-channel-project_id',
            'channel'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-channel-project_id',
            'channel'
        );

        $this->dropTable('channel');
    }
}
