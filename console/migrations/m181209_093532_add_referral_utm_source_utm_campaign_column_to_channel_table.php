<?php

use yii\db\Migration;

/**
 * Handles adding referral_utm_source_utm_campaign to table `channel`.
 */
class m181209_093532_add_referral_utm_source_utm_campaign_column_to_channel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('channel', 'referral', $this->string());
        $this->addColumn('channel', 'utm_source', $this->string());
        $this->addColumn('channel', 'utm_campaign', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('channel', 'referral');
        $this->dropColumn('channel', 'utm_source');
        $this->dropColumn('channel', 'utm_campaign');
    }
}
