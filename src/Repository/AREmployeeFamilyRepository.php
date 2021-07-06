<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\EmployeeFamilyNotFoundException;
use App\Model\EmployeeFamily;
use Ramsey\Uuid\Uuid;

class AREmployeeFamilyRepository implements EmployeeFamilyRepository
{
    public function get(string $id): EmployeeFamily
    {
        if (($model = EmployeeFamily::findOne($id)) === null) {
            throw new EmployeeFamilyNotFoundException(sprintf("EmployeeFamily not found with id '%s'", $id));
        }

        return $model;
    }

    public function store(EmployeeFamily $EmployeeFamily): void
    {
        $EmployeeFamily->save(false);
    }

    public function delete(EmployeeFamily $EmployeeFamily): void
    {
        $EmployeeFamily->beforeDelete();
        EmployeeFamily::deleteAll(['id' => $EmployeeFamily->id]);
        $EmployeeFamily->afterDelete();
    }

    public function nextId(): string
    {
        return Uuid::uuid6()->toString();
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }
}
