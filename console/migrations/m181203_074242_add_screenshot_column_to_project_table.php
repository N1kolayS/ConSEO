<?php

use yii\db\Migration;

/**
 * Handles adding screenshot to table `project`.
 */
class m181203_074242_add_screenshot_column_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('project', 'screenShot', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('project', 'screenShot');
    }
}
