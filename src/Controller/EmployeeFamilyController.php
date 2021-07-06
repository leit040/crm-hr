<?php

declare(strict_types=1);

namespace App\Controller;


use App\Form\EmployeeFamilyCreateForm;
use App\Form\EmployeeFamilyUpdateForm;
use app\Model\EmployeeFamily;
use App\Repository\EmployeeFamilyRepository;
use App\Response\EmptyResponse;
use App\UseCase\EmployeeFamilyManagementService;
use yii\data\ActiveDataProvider;

class EmployeeFamilyController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/employee-family/index",
     *     tags={"Employee Family"},
     *     summary="Get employeefamily",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/EmployeeFamily")),
     *              @OA\Property(property="_meta", type="object", ref="#/components/schemas/Meta"),
     *          )
     *     )
     * )
     */


    public function actionIndex(): ActiveDataProvider
    {

        return new ActiveDataProvider([
            'query' => EmployeeFamily::find(),
        ]);

    }

    /**
     * @OA\Get(
     *     path="/employee-family/view",
     *     tags={"Employee Family"},
     *     summary="Get specific employeefamily",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeFamily")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Employee Family Id id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )),
     *     )
     * )
     */


    public function actionView(string $id, EmployeeFamilyRepository $employeeFamilyRepository): EmployeeFamily
    {
        return $employeeFamilyRepository->get($id);

    }


    /**
     * @OA\Post(
     *     path="/employee-family/create",
     *     tags={"Employee Family"},
     *     summary="Create Employee Family member",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeFamily")),
     *     @OA\RequestBody(
     *         description="Requested body",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/EmployeeFamilyCreateForm"),
     *     )
     * )
     */


    public function actionCreate(EmployeeFamilyManagementService $employeeFamilyManagementService, EmployeeFamilyRepository $employeeFamilyRepository): EmployeeFamily|EmployeefamilyCreateForm
    {

        $form = new EmployeeFamilyCreateForm();
        $this->load($form);

        if ($form->validate()) {
            return $employeeFamilyManagementService->save($form);

        }
        return $form;

    }

    /**
     * @OA\Put(
     *    path="/employee-family/update",
     *     tags={"Employee Family"},
     *     summary="Update Employee Family member",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeFamilyUpdate")),
     *     @OA\RequestBody(
     *         description="Requested body",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/EmployeeFamilyUpdate")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="EmployeeFamily id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     )
     * )
     */


    public function actionUpdate(string $id, EmployeeFamilyManagementService $employeeFamilyManagementService, EmployeeFamilyRepository $employeeFamilyRepository)
    {
        $model = $employeeFamilyRepository->get($id);
        $form = new EmployeeFamilyUpdateForm();
        $this->load($form);
        if ($form->validate()) {
            return $employeeFamilyManagementService->update($id, $form);

        }
        return $form;

    }


    /**
     * @OA\Delete (
     *      path="/employee-family/update",
     *     tags={"Employee Family"},
     *     summary="Delete Employee Family member",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Employee family id",
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


    public function actionDelete(string $id, EmployeeFamilyRepository $employeeFamilyRepository): EmptyResponse
    {
        $employeeFamilyRepository->delete($employeeFamilyRepository->get($id));

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
