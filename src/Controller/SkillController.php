<?php

declare(strict_types=1);

namespace App\Controller;


use App\Form\SkillCreateForm;
//use App\Form\SkillUpdateForm;
use App\Form\SkillUpdateForm;
use app\Model\Skill;
use App\Repository\SkillRepository;
use App\Response\EmptyResponse;
use App\UseCase\SkillManagementService;
use yii\data\ActiveDataProvider;

class SkillController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/skill/index",
     *     tags={"Skill"},
     *     summary="Get Skill",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Skill")),
     *              @OA\Property(property="_meta", type="object", ref="#/components/schemas/Meta"),
     *          )
     *     )
     * )
     */


    public function actionIndex(): ActiveDataProvider
    {

        return new ActiveDataProvider([
            'query' => Skill::find(),
        ]);

    }

    /**
     * @OA\Get(
     *     path="/skill/view",
     *     tags={"Skill"},
     *     summary="Get specific Skill",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Skill")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Skill id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )),
     *     )
     * )
     */


    public function actionView(string $id, SkillRepository $skillRepository): Skill
    {
        return $skillRepository->get($id);

    }


    /**
     * @OA\Post(
     *     path="/skill/create",
     *     tags={"Skill"},
     *     summary="Create Employee Family member",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Skill")),
     *     @OA\RequestBody(
     *         description="Requested body",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SkillCreateForm"),
     *     )
     * )
     */


    public function actionCreate(SkillManagementService $skillManagementService, SkillRepository $skillRepository): Skill|SkillCreateForm
    {

        $form = new SkillCreateForm();
        $this->load($form);

        if ($form->validate()) {
            return $skillManagementService->save($form);

        }
        return $form;

    }




    /**
     * @OA\Delete (
     *      path="/skill/update",
     *     tags={"Skill"},
     *     summary="Delete Employee Family member",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Skill id",
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


    public function actionDelete(string $id, SkillRepository $skillRepository): EmptyResponse
    {
        $skillRepository->delete($skillRepository->get($id));

        return new EmptyResponse(204);
    }

    protected function verbs(): array
    {
        return [
            'create' => ['POST'],
            'delete' => ['DELETE'],
            'index' => ['GET'],
            'view' => ['GET'],
        ];
    }


    /**
     * @OA\Put(
     *     path="/Skill/update",
     *     tags={"Skills"},
     *     summary="Update Skill",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SkillUpdate")),
     *     @OA\RequestBody(
     *         description="Requested body",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SkillUpdateForm")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Skill id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     )
     * )
     */


    public function actionUpdate(string $id, SkillManagementService $skillManagementService, SkillRepository $skillRepository): SkillUpdateForm|Skill|null
    {
        $model = $skillRepository->get($id);
        $form = new SkillUpdateForm();
        $this->load($form);
        if ($form->validate()) {
            return $skillManagementService->update($id, $form);

        }
        return $form;

    }


}
