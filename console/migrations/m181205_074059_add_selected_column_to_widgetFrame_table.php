<?php

use yii\db\Migration;

/**
 * Handles adding selected to table `widgetFrame`.
 */
class m181205_074059_add_selected_column_to_widgetFrame_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('widgetFrame', 'selected', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('widgetFrame', 'selected');
    }
}
