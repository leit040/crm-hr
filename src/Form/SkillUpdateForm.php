<?php

declare(strict_types=1);

namespace App\Form;


use App\Model\BaseModel;
use yii\base\Model;

/**
 * @OA\Schema(
 *     required={"name"},
 *     title="Update Skill form"
 * )
 */
final class SkillUpdateForm extends BaseModel
{


    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $id = '';

    /**
     * @OA\Property(
     *     format="string",
     * )
     */
    public string $name = '';


    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 512],
        ];
    }


}


