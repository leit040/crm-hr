<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee_skill}}`.
 */
class m210620_150119_create_employee_skill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee_skill}}', [
            'employee_id' => $this->string(36)->notNull(),
            'skill_id' => $this->string(36)->notNull(),
        ]);



        $this->addForeignKey(
            'fk-employee_skill-employee_id',
            'employee_skill',
            'employee_id',
            'employee',
            'user_id'
        );

        $this->addForeignKey(
            'fk-employee_skill-skill_id',
            'employee_skill',
            'skill_id',
            'skill',
            'id'
        );





    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()

    {
        $this->dropForeignKey('fk-employee_skill-employee_id','{{%employee_skill}}');
        $this->dropForeignKey('fk-employee_skill-skill_id','{{%employee_skill}}');
        $this->dropTable('{{%employee_skill}}');
    }
}
