<?php

declare(strict_types=1);

namespace App\UseCase;


use App\Form\SkillCreateForm;
use App\Form\SkillUpdateForm;
use app\Model\Skill;
use App\Model\TransactionManager;
use App\Repository\SkillRepository;

final class SkillManagementService

{
    private TransactionManager $transactionManager;
    private SkillRepository $skillRepository;


    public function __construct(TransactionManager $transactionManager, SkillRepository $skillRepository)
    {
        $this->transactionManager = $transactionManager;
        $this->skillRepository = $skillRepository;

    }

    public function save(SkillCreateForm | SkillUpdateForm $form)
    {
        if($skill = $this->skillRepository->getSkill($form->name))
        {return $skill;}

        $skill = Skill::create($form->name);
        $this->transactionManager->wrap(function () use ($skill) {
            $this->skillRepository->store($skill);
        });
        return $skill;
    }

    public function update(string $SkillId, SkillUpdateForm $form): Skill
    {
        if($skill = $this->skillRepository->getSkill($form->name))
        {return $skill;}

        $Skill = $this->skillRepository->get($SkillId);
        $this->transactionManager->wrap(function () use ($form, $Skill) {
            $Skill->updateData($form->name);
            $this->skillRepository->store($Skill);
        });
        return $Skill;
    }



}