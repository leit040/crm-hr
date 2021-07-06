<?php

declare(strict_types=1);

namespace App\Form;


use yii\base\Model;

/**
 * @OA\Schema(
 *     required={"fullName", "type", "contacts"},
 *     title="Create  Employee Family Update form"
 * )
 */
final class EmployeeFamilyUpdateForm extends Model
{
   public string $employeeId = '';

   public string $id = '';

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
    public string $type = '';
    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $contacts = '';


    public function rules()
    {
        return [
            [['fullName', 'type'], 'required'],
            [['contacts'], 'string'],
            [['fullName'], 'string', 'max' => 512],
            [['type'], 'string', 'max' => 255],
        ];
    }


}


