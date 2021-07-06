<?php

declare(strict_types=1);

namespace App\Form;


use app\Model\EmployeeFamily;
use yii\base\Model;

/**
 * @OA\Schema(
 *     required={"userId", "fullName","dateOfBirth","startOfWork", "positionAtCompany","education","city", "contacts"},
 *     title="Create Employee form"
 * )
 */
class EmployeeCreateForm extends Model
{
    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $userId = '';

    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public ?string $avatarPath = null;
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
    public string $dateOfBirth = '';

    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $startOfWork = '';

    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $positionAtCompany = '';

    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $education = '';

    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $city = '';


    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $contacts = '';
    /**
     * @OA\Property(property="employeeFamily", type="array", @OA\Items(ref="#/components/schemas/EmployeeFamily")),
     * )
     */


    public array $employeeFamily = [];

    /**
     * @OA\Property(property="skill", type="array", @OA\Items(ref="#/components/schemas/Skill")),
     * )
     */

    public array $skill = [];

    public function rules()
    {
        return [
            [['userId', 'fullName', 'dateOfBirth', 'startOfWork', 'positionAtCompany', 'education', 'city', 'contacts'], 'required'],
            [['contacts', 'education'], 'string'],
            [['userId'], 'string', 'max' => 36],
            [['fullName', 'avatarPath'], 'string', 'max' => 512],
            [['positionAtCompany'], 'string', 'max' => 255],
            [['employeeFamily'], 'employeeFamilyValidator'],
            [['skill'],'skillValidator']
        ];
    }

    public function employeeFamilyValidator($attribute,$params)
    {

        if (!Model::validateMultiple($this->employeeFamily)) {
            {
                $this->addError('employeeFamily', \Yii::t('app', 'Invalid input on employeeFamily.'));

            }

        }
    }


    public function skillValidator($attribute,$params){
        if(!Model::validateMultiple($this->skill)){
            $this->addError('skill', \Yii::t('app', 'Invalid input on Skill.'));

        }


    }

}


