<?php

use yii\db\Migration;

/**
 * Handles adding sort to table `map_referral`.
 */
class m181212_073533_add_sort_column_to_map_referral_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('map_referral', 'sort', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('map_referral', 'sort');
    }
}
