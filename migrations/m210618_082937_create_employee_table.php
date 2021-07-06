<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m210618_082937_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'user_id' => $this->string(36)->notNull(),
            'avatar_path' => $this->string(512),
            'full_name' => $this->string(36)->notNull(),
            'date_of_birth' => $this->date()->notNull(),
            'start_of_work' => $this->date()->notNull(),
            'position_at_company' => $this->string(255)->notNull(),
            'education' => $this->text(),
            'city' => $this->text()->notNull(),
            'contacts' => $this->text()->notNull(),
        ]);
        $this->addPrimaryKey('pk_employee', '{{%employee}}', 'user_id');

        $this->addForeignKey(
            'fk-employee_family-employee_id',
            'employee_family',
            'employee_id',
            'employee',
            'user_id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-employee_family-employee_id','{{%employee_family}}');
        $this->dropTable('{{%employee}}');
    }
}
