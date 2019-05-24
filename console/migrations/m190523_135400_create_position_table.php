<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%position}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%project}}`
 */
class m190523_135400_create_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%position}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'htmlId' => $this->string(),
            'htmlClass' => $this->string(),
        ]);

        // creates index for column `project_id`
        $this->createIndex(
            '{{%idx-position-project_id}}',
            '{{%position}}',
            'project_id'
        );

        // add foreign key for table `{{%project}}`
        $this->addForeignKey(
            '{{%fk-position-project_id}}',
            '{{%position}}',
            'project_id',
            '{{%project}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%project}}`
        $this->dropForeignKey(
            '{{%fk-position-project_id}}',
            '{{%position}}'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            '{{%idx-position-project_id}}',
            '{{%position}}'
        );

        $this->dropTable('{{%position}}');
    }
}
