<?php

declare(strict_types=1);

namespace App\UseCase;


use App\Form\EmployeeCreateForm;
use App\Form\EmployeeFamilyCreateForm;
use App\Form\EmployeeUpdateForm;
use app\Model\Employee;
use App\Model\TransactionManager;
use App\Repository\EmployeeFamilyRepository;
use App\Repository\EmployeeRepository;
use yii\helpers\ArrayHelper;

final class EmployeeManagementService

{
    private TransactionManager $transactionManager;
    private EmployeeRepository $employeeRepository;
    private EmployeeFamilyRepository $employeeFamilyRepository;
    private EmployeeFamilyManagementService $employeeFamilyManagementService;
    private  SkillManagementService $skillManagementService;


    public function __construct(TransactionManager $transactionManager, EmployeeRepository $employeeRepository,
                                EmployeeFamilyManagementService $employeeFamilyManagementService, EmployeeFamilyRepository $employeeFamilyRepository,SkillManagementService $skillManagementService)
    {
        $this->transactionManager = $transactionManager;
        $this->employeeRepository = $employeeRepository;
        $this->employeeFamilyManagementService = $employeeFamilyManagementService;
        $this->employeeFamilyRepository = $employeeFamilyRepository;
        $this->skillManagementService = $skillManagementService;

    }

    public function save(EmployeeCreateForm $form)
    {


        $Employee = Employee::create($form->userId, $form->avatarPath, $form->fullName, $form->dateOfBirth, $form->startOfWork, $form->positionAtCompany, $form->education, $form->city, $form->contacts);
        $this->transactionManager->wrap(function () use ($Employee,$form) {
            $this->employeeRepository->store($Employee);

        foreach ($form->employeeFamily as $employeeFamily) {
            $employeeFamily->employeeId = $form->userId;
            $this->employeeFamilyManagementService->save($employeeFamily);
        }
        foreach ($form->skill as $skill) {
            $skillItem = $this->skillManagementService->save($skill);
            $Employee->link('skill', $skillItem);
        }
        });




        return $Employee;
    }

    public function update(string $employeeId, EmployeeUpdateForm $form): Employee
    {
        $employee = $this->employeeRepository->get($employeeId);
        $oldIDs = ArrayHelper::map($employee->employeeFamily, 'id', 'id');
        $deleteIDs = array_diff($oldIDs, ArrayHelper::map($form->employeeFamily, 'id', 'id'));

        if (!empty($deleteIDs)) {

            foreach ($deleteIDs as $id) {
            $model = $this->employeeFamilyRepository->get($id);
            $this->employeeFamilyRepository->delete($model);
           }
        }




        $this->transactionManager->wrap(function () use ($form, $employee) {
            $employee->updateData($form->avatarPath, $form->fullName, $form->dateOfBirth, $form->startOfWork, $form->positionAtCompany, $form->education, $form->city, $form->contacts);
            $employee->unlinkAll('skill',true);
            $this->employeeRepository->store($employee);
            $employee->save(false);
                        foreach ($form->employeeFamily as $employeeFamilyMember) {
                if ($model = $this->employeeFamilyRepository->findById($employeeFamilyMember->id)) {
                    $model = $this->employeeFamilyManagementService->update($employeeFamilyMember->id, $employeeFamilyMember);
                } else {
                    if($employeeFamilyMember->id==''){
                    $employeeFamilyMember->employeeId = $employee->user_id;
                    $this->employeeFamilyManagementService->save($employeeFamilyMember);
                    }
                }
            }
            foreach ($form->skill as $skillItem){
           //  var_dump($skill);
                $skillItem = $this->skillManagementService->save($skillItem);
             $employee->link('skill',$skillItem);
            }


        });
        return $employee;

    }

}