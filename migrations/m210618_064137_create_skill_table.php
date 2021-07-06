<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%skill}}`.
 */
class m210618_064137_create_skill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%skill}}', [
            'id' => $this->string(36)->notNull(),
            'name' => $this->string(512)->notNull()->unique(),
        ]);
        $this->addPrimaryKey('pk_skill', '{{%skill}}', 'id');
        $this->createIndex('i_skill','skill','name',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%skill}}');
    }
}
