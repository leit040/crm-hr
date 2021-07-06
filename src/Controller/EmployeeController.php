<?php

declare(strict_types=1);

namespace App\Controller;


use App\Form\EmployeeCreateForm;
use App\Form\EmployeeFamilyCreateForm;
use App\Form\EmployeeFamilyUpdateForm;
use App\Form\EmployeeUpdateForm;
use App\Form\SkillCreateForm;
use App\Form\SkillUpdateForm;
use app\Model\Employee;
use App\Model\EmployeeSearch;
use App\Repository\EmployeeRepository;
use App\Response\EmptyResponse;
use App\UseCase\EmployeeManagementService;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class EmployeeController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/employee/index",
     *     tags={"Employee"},
     *     summary="Get Employee",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Employee")),
     *              @OA\Property(property="_meta", type="object", ref="#/components/schemas/Meta"),
     *          )
     *     )
     * )
     */


    public function actionIndex(): ActiveDataProvider
    {

        return new ActiveDataProvider([
            'query' => Employee::find(),
        ]);

    }

    /**
     * @OA\Get(
     *     path="/employee/search",
     *     tags={"Employee"},
     *     summary="Get Employee by filter",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Employee")),
     *              @OA\Property(property="_meta", type="object", ref="#/components/schemas/Meta"))),
     *      @OA\Parameter(
     *         name="skillLike",
     *         in="query",
     *         description="Skill name, %Like%",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )),
     *     @OA\Parameter(
     *         name="fullNameLike",
     *         in="query",
     *         description="Employee name, %Like%",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )),
     *     @OA\Parameter(
     *         name="positionAtCompanyLike",
     *         in="query",
     *         description="Position at company, %Like%",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *          )
     *     )
     * )
     */

    public function actionSearch(): ActiveDataProvider
    {
        $searchModel = new EmployeeSearch();
        return $searchModel->search(\Yii::$app->request->get());

    }

    /**
     * @OA\Get(
     *     path="/employee/view",
     *     tags={"Employee"},
     *     summary="Get specific Employee",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Employee")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Employee id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )),
     *     @OA\Parameter(
     *         name="expand",
     *         in="query",
     *         description="familyMembers,skill",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )),
     *     )
     * )
     */


    public function actionView(string $id, EmployeeRepository $employeeRepository): Employee
    {
        return $employeeRepository->get($id);

    }


    /**
     * @OA\Post(
     *     path="/employee/create",
     *     tags={"Employee"},
     *     summary="Create Employee member",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Employee")),
     *     @OA\RequestBody(
     *         description="Requested body",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/EmployeeCreateForm"),
     *     )
     * )
     */


    public function actionCreate(EmployeeManagementService $EmployeeManagementService, EmployeeRepository $EmployeeRepository): Employee|EmployeeCreateForm
    {

        $form = new EmployeeCreateForm();
        $this->load($form);
        if ($employeeFamilyData = \Yii::$app->getRequest()->getBodyParam('employeeFamily') !== null) {
            $form->employeeFamily = ArrayHelper::getColumn($form->employeeFamily, function ($arrayData) {
                return new EmployeeFamilyCreateForm($arrayData);
            });
      }
        if($skillData = \Yii::$app->getRequest()->getBodyParam('skill') !== null){
        $form->skill = ArrayHelper::getColumn($form->skill, function ($arrayData) {
            return new SkillCreateForm($arrayData);
        });
        }

           if ($form->validate()) {
            return $EmployeeManagementService->save($form);

        }
        return $form;

    }

    /**
     * @OA\Put(
     *    path="/employee/update",
     *     tags={"Employee"},
     *     summary="Update Employee  member",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeUpdate")),
     *     @OA\RequestBody(
     *         description="Requested body",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/EmployeeUpdateForm")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Employee id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     )
     * )
     */


    public function actionUpdate(string $id, EmployeeManagementService $EmployeeManagementService, EmployeeRepository $EmployeeRepository): EmployeeUpdateForm|Employee
    {
        $model = $EmployeeRepository->get($id);
        $form = new EmployeeUpdateForm();
        $this->load($form);
        if (($employeeFamilyData = \Yii::$app->getRequest()->getBodyParam('employeeFamily')) !== null) {
            $form->employeeFamily = ArrayHelper::getColumn($form->employeeFamily, function ($arrayData) {
                return new EmployeeFamilyUpdateForm($arrayData);
            });
            if (($employeeSkillData = \Yii::$app->getRequest()->getBodyParam('skill')) !== null) {
                $form->skill = ArrayHelper::getColumn($form->skill, function ($arrayData) {
                    return new SkillUpdateForm($arrayData);
                });
            if ($form->validate()) {
                return $EmployeeManagementService->update($id, $form);


            }
        }
        return $form;

    }
    }


    /**
     * @OA\Delete (
     *      path="/employee/update",
     *     tags={"Employee"},
     *     summary="Delete Employee ",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Employee id",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="successful operation"
     *     )
     * )
     */


    public function actionDelete(string $id, EmployeeRepository $employeeRepository): EmptyResponse
    {
        $employeeRepository->delete($employeeRepository->get($id));

        return new EmptyResponse(204);
    }

    protected function verbs(): array
    {
        return [
            'create' => ['POST'],
            'update' => ['PUT'],
            'delete' => ['DELETE'],
            'index' => ['GET'],
            'view' => ['GET'],
        ];
    }
}
