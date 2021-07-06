<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\EmployeeNotFoundException;
use App\Model\Employee;
use Ramsey\Uuid\Uuid;

class AREmployeeRepository implements EmployeeRepository
{
    public function get(string $id): Employee
    {
        if (($model = Employee::findOne($id)) === null) {
            throw new EmployeeNotFoundException(sprintf("Employee not found with id '%s'", $id));
        }

        return $model;
    }

    public function store(Employee $Employee): void
    {
        $Employee->save(false);
    }

    public function delete(Employee $Employee): void
    {
        $Employee->beforeDelete();
        Employee::deleteAll(['user_id' => $Employee->user_id]);
        $Employee->afterDelete();
    }

    public function nextId(): string
    {
        return Uuid::uuid6()->toString();
    }
}
