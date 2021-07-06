<?php

declare(strict_types=1);

namespace App\Form;


use yii\base\Model;

/**
 * @OA\Schema(
 *     required={"name"},
 *     title="Create Skill form"
 * )
 */
final class SkillCreateForm extends Model
{

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


