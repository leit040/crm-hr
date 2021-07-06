<?php

declare(strict_types=1);

namespace App\Form;


use yii\base\Model;

/**
 * @OA\Schema(
 *     required={"employeeId", "fullName","type",  "contacts"},
 *     title="Create EmployeeFamily form"
 * )
 */
final class EmployeeFamilyCreateForm extends Model
{

    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $employeeId = '';
    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $type = '';
    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $fullName = '';
    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $contacts = '';


    public function rules()
    {
        return [
            [['fullName', 'type','contacts'], 'required'],
            [['contacts'], 'string'],
            [['employeeId'], 'string', 'max' => 36],
            [['fullName'], 'string', 'max' => 512],
            [['type'], 'string', 'max' => 255],
        ];
    }


}


