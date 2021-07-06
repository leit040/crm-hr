<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Employee;

interface EmployeeRepository
{
    public function get(string $id): Employee;

    public function store(Employee $Employee): void;

    public function nextId(): string;

    public function delete(Employee $Employee): void;
}
