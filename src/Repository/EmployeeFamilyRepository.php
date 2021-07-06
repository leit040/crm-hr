<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\EmployeeFamily;

interface EmployeeFamilyRepository
{
    public function get(string $id): EmployeeFamily;

    public function store(EmployeeFamily $EmployeeFamily): void;

    public function nextId(): string;

    public function delete(EmployeeFamily $EmployeeFamily): void;

    public function findById($id);
}
