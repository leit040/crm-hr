<?php

namespace app\Model;

use Ramsey\Uuid\Uuid;
use Yii;

/**
 * This is the model class for table "employee_family".
 *
 * @property string $id
 * @property string $employee_id
 * @property string $full_name
 * @property string $type
 * @property string|null $contacts
 *
 * @property Employee
 */
class EmployeeFamily extends \App\Model\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'employee_family';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'full_name', 'type'], 'required'],
            [['contacts'], 'string'],
            [['id', 'employee_id'], 'string', 'max' => 36],
            [['full_name'], 'string', 'max' => 512],
            [['type'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'type' => Yii::t('app', 'Type'),
            'contacts' => Yii::t('app', 'Contacts'),
        ];
    }

    public function fields(): array
    {
        return [
            'id',
            'employeeId' => 'employee_id',
            'fullName' => 'full_name',
            'type',
            'contacts'

        ];
    }


    public function getEmployee(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Employee::class, ['employee' => 'user_id']);
    }

    public static function create(string $employeeId, string $fullName, string $type, string $contacts): self
    {
        $model = new self();
        $model->id = Uuid::uuid6()->toString();
        $model->employee_id = $employeeId;
        $model->full_name = $fullName;
        $model->type = $type;
        $model->contacts = $contacts;
        return $model;
    }

    public function updateData(string $fullName, string $type, string $contacts)
    {

        $this->full_name = $fullName;
        $this->type = $type;
        $this->contacts = $contacts;
    }

}

