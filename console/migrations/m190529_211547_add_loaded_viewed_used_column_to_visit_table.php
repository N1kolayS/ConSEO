<?php

use yii\db\Migration;

/**
 * Handles adding loaded_viewed_used to table `{{%visit}}`.
 */
class m190529_211547_add_loaded_viewed_used_column_to_visit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%visit}}', 'loaded', $this->integer()->defaultValue(0));
        $this->addColumn('{{%visit}}', 'viewed', $this->integer()->defaultValue(0));
        $this->addColumn('{{%visit}}', 'used', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%visit}}', 'loaded');
        $this->dropColumn('{{%visit}}', 'viewed');
        $this->dropColumn('{{%visit}}', 'used');
    }
}
