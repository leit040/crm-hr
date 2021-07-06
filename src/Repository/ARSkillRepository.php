<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\SkillNotFoundException;
use App\Model\Skill;
use Ramsey\Uuid\Uuid;

class ARSkillRepository implements SkillRepository
{
    public function get(string $id): Skill
    {
        if (($model = Skill::findOne($id)) === null) {
            throw new SkillNotFoundException(sprintf("Skill not found with id '%s'", $id));
        }

        return $model;
    }

    public function store(Skill $skill): void
    {
        $skill->save(false);
    }

    public function delete(Skill $skill): void
    {
        $skill->beforeDelete();
        Skill::deleteAll(['id' => $skill->id]);
        $skill->afterDelete();
    }

    public function nextId(): string
    {
        return Uuid::uuid6()->toString();
    }

    public function getSkill(string $name): ?Skill
    {
        if($skill = Skill::find()->where(['name'=>$name])->one()){

        return $skill;
        }
        return null;


    }

}
