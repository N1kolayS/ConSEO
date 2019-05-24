<?php

use yii\db\Migration;

/**
 * Handles adding wMultiStatus to table `{{%project}}`.
 */
class m190523_151804_add_wMultiStatus_column_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project}}', 'wMultiStatus', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%project}}', 'wMultiStatus');
    }
}
