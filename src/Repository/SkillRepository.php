<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Skill;

interface SkillRepository
{
    public function get(string $id): Skill;

    public function store(Skill $Skill): void;

    public function nextId(): string;

    public function delete(Skill $Skill): void;

    public function getSkill(string $name): ?Skill;
}
