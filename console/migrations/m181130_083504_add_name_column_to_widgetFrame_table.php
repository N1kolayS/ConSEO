<?php

use yii\db\Migration;

/**
 * Handles adding name to table `widgetFrame`.
 */
class m181130_083504_add_name_column_to_widgetFrame_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('widgetFrame', 'name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('widgetFrame', 'name');
    }
}
