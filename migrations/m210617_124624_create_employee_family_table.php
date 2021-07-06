<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee_family}}`.
 */
class m210617_124624_create_employee_family_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee_family}}', [
            'id' => $this->string(36)->notNull(),
            'employee_id' => $this->string(36)->notNull(),
            'full_name' => $this->string(512)->notNull(),
            'type' => $this->string(255)->notNull(),
            'contacts' => $this->text(),
        ]);

        $this->addPrimaryKey('pk_employee_family', '{{%employee_family}}', 'id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee_family}}');
    }
}
