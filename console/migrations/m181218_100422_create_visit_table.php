<?php

use yii\db\Migration;

/**
 * Handles the creation of table `visit`.
 * Has foreign keys to the tables:
 *
 * - `project`
 * - `channel`
 */
class m181218_100422_create_visit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('visit', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'channel_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'mobile' => $this->integer(),
            'url' => $this->string(),
            'ref' => $this->string(),
            'browser' => $this->string(),
            'ip' => $this->string(),
            'cookie' => $this->string(),
            'info' => $this->string(),
            'loaded' => $this->integer(),
            'viewed' => $this->integer(),
            'used' => $this->integer(),
        ]);

        // creates index for column `project_id`
        $this->createIndex(
            'idx-visit-project_id',
            'visit',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-visit-project_id',
            'visit',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );

        // creates index for column `channel_id`
        $this->createIndex(
            'idx-visit-channel_id',
            'visit',
            'channel_id'
        );

        // add foreign key for table `channel`
        $this->addForeignKey(
            'fk-visit-channel_id',
            'visit',
            'channel_id',
            'channel',
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
            'fk-visit-project_id',
            'visit'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-visit-project_id',
            'visit'
        );

        // drops foreign key for table `channel`
        $this->dropForeignKey(
            'fk-visit-channel_id',
            'visit'
        );

        // drops index for column `channel_id`
        $this->dropIndex(
            'idx-visit-channel_id',
            'visit'
        );

        $this->dropTable('visit');
    }
}
