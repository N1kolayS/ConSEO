<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%channel_position}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%channel}}`
 * - `{{%position}}`
 */
class m190523_135501_create_junction_table_for_channel_and_position_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%channel_position}}', [
            'channel_id' => $this->integer(),
            'position_id' => $this->integer(),
            'val' => $this->string(),
            'PRIMARY KEY(channel_id, position_id)',
        ]);

        // creates index for column `channel_id`
        $this->createIndex(
            '{{%idx-channel_position-channel_id}}',
            '{{%channel_position}}',
            'channel_id'
        );

        // add foreign key for table `{{%channel}}`
        $this->addForeignKey(
            '{{%fk-channel_position-channel_id}}',
            '{{%channel_position}}',
            'channel_id',
            '{{%channel}}',
            'id',
            'CASCADE'
        );

        // creates index for column `position_id`
        $this->createIndex(
            '{{%idx-channel_position-position_id}}',
            '{{%channel_position}}',
            'position_id'
        );

        // add foreign key for table `{{%position}}`
        $this->addForeignKey(
            '{{%fk-channel_position-position_id}}',
            '{{%channel_position}}',
            'position_id',
            '{{%position}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%channel}}`
        $this->dropForeignKey(
            '{{%fk-channel_position-channel_id}}',
            '{{%channel_position}}'
        );

        // drops index for column `channel_id`
        $this->dropIndex(
            '{{%idx-channel_position-channel_id}}',
            '{{%channel_position}}'
        );

        // drops foreign key for table `{{%position}}`
        $this->dropForeignKey(
            '{{%fk-channel_position-position_id}}',
            '{{%channel_position}}'
        );

        // drops index for column `position_id`
        $this->dropIndex(
            '{{%idx-channel_position-position_id}}',
            '{{%channel_position}}'
        );

        $this->dropTable('{{%channel_position}}');
    }
}
