<?php

declare(strict_types=1);

namespace App\Definitions;

/**
 * @OA\Schema(
 *     @OA\Property(property="userId", type="string"),
 *     @OA\Property(property="avatarPath", type="string"),
 *     @OA\Property(property="fullName", type="string"),
 *     @OA\Property(property="dateOfBirth", type="string"),
 *     @OA\Property(property="startOfWork", type="string"),
 *     @OA\Property(property="positionAtCompany", type="string"),
 *     @OA\Property(property="education", type="string"),
 *     @OA\Property(property="city", type="string"),
 *     @OA\Property(property="contacts", type="string"),
 *     @OA\Property(property="skill", type="array", @OA\Items(ref="#/components/schemas/Skill")),
 *     @OA\Property(property="employeeFamily", type="array", @OA\Items(ref="#/components/schemas/EmployeeFamily")),
 * )
 */
final class Employee
{
}
