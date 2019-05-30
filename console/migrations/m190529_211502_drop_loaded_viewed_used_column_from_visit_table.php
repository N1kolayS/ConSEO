<?php

use yii\db\Migration;

/**
 * Handles dropping loaded_viewed_used from table `{{%visit}}`.
 */
class m190529_211502_drop_loaded_viewed_used_column_from_visit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%visit}}', 'loaded');
        $this->dropColumn('{{%visit}}', 'viewed');
        $this->dropColumn('{{%visit}}', 'used');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%visit}}', 'loaded', $this->integer());
        $this->addColumn('{{%visit}}', 'viewed', $this->integer());
        $this->addColumn('{{%visit}}', 'used', $this->integer());
    }
}
