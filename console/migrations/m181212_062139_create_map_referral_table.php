<?php

use yii\db\Migration;

/**
 * Handles the creation of table `map_referral`.
 */
class m181212_062139_create_map_referral_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('map_referral', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'url' => $this->string(),
            'type_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('map_referral');
    }
}
