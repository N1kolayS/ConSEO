<?php

use yii\db\Migration;

/**
 * Handles the creation of table `widgetFrame`.
 * Has foreign keys to the tables:
 *
 * - `project`
 * - `template`
 */
class m181120_172447_create_widgetFrame_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('widgetFrame', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'template_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'title_flip' => $this->string(),
            'text' => $this->string(),
            'phone' => $this->string(),
            'position' => $this->integer(),
            'enable' => $this->integer()->defaultValue(1),
        ]);

        // creates index for column `project_id`
        $this->createIndex(
            'idx-widgetFrame-project_id',
            'widgetFrame',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-widgetFrame-project_id',
            'widgetFrame',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );

        // creates index for column `template_id`
        $this->createIndex(
            'idx-widgetFrame-template_id',
            'widgetFrame',
            'template_id'
        );

        // add foreign key for table `template`
        $this->addForeignKey(
            'fk-widgetFrame-template_id',
            'widgetFrame',
            'template_id',
            'template',
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
            'fk-widgetFrame-project_id',
            'widgetFrame'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-widgetFrame-project_id',
            'widgetFrame'
        );

        // drops foreign key for table `template`
        $this->dropForeignKey(
            'fk-widgetFrame-template_id',
            'widgetFrame'
        );

        // drops index for column `template_id`
        $this->dropIndex(
            'idx-widgetFrame-template_id',
            'widgetFrame'
        );

        $this->dropTable('widgetFrame');
    }
}
