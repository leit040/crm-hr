<?php

declare(strict_types=1);

namespace App\UseCase;


use App\Form\EmployeeFamilyCreateForm;
use App\Form\EmployeeFamilyUpdateForm;
use app\Model\EmployeeFamily;
use App\Model\TransactionManager;
use App\Repository\EmployeeFamilyRepository;

final class EmployeeFamilyManagementService

{
    private TransactionManager $transactionManager;
    private EmployeeFamilyRepository $EmployeeFamilyRepository;


    public function __construct(TransactionManager $transactionManager, EmployeeFamilyRepository $EmployeeFamilyRepository)
    {
        $this->transactionManager = $transactionManager;
        $this->EmployeeFamilyRepository = $EmployeeFamilyRepository;

    }

    public function save(EmployeeFamilyUpdateForm | EmployeeFamilyCreateForm $form)
    {
       $EmployeeFamily = EmployeeFamily::create($form->employeeId, $form->fullName, $form->type, $form->contacts);
        $this->transactionManager->wrap(function () use ($EmployeeFamily) {
            $this->EmployeeFamilyRepository->store($EmployeeFamily);
        });
        return $EmployeeFamily;
    }

    public function update(string $EmployeeFamilyId, EmployeeFamilyUpdateForm $form)
    {
        $EmployeeFamily = $this->EmployeeFamilyRepository->get($EmployeeFamilyId);
        $this->transactionManager->wrap(function () use ($form, $EmployeeFamily) {
            $EmployeeFamily->updateData($form->fullName, $form->type, $form->contacts);
            $this->EmployeeFamilyRepository->store($EmployeeFamily);
        });
        return $EmployeeFamily;
    }



}