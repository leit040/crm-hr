<?php


namespace App\Console;


use app\Model\Employee;
use app\Model\EmployeeFamily;
use app\Model\Skill;
use App\UseCase\SkillManagementService;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

class SeedController extends \yii\base\Controller
{

    public function actionSeed(){
        foreach (['Php','Golang','Java-script','Unix','Yii2','OOP','C++','Laravel'] as $skill){
        $skillModel = Skill::create($skill);
        $skillModel->save();

        }


        $faker = \Faker\Factory::create();
        for ($i=0;$i<100;$i++){
        $model = new Employee();
        $model->user_id =Uuid::uuid6()->toString();
        $model->full_name = $faker->name;
        $model->position_at_company = $faker->jobTitle;
        $model->city = $faker->city;
        $model->education = $faker->words(3,7);
        $model->date_of_birth = $faker->dateTimeInInterval($startDate = '-45 years', $endDate = '-18 years', $timezone = null)->format('Y-m-d');
        $model->start_of_work = $faker->dateTimeInInterval($startDate = '-7 years', $endDate = '-1 month', $timezone = null)->format('Y-m-d');
        $model->contacts = $faker->email." ".$faker->phoneNumber;
        $model->save();
        $contactModel = new EmployeeFamily();
        $contactModel->id = Uuid::uuid6()->toString();
        $contactModel->employee_id = $model->user_id;
        $contactModel->full_name = $faker->name;
        $contactModel->contacts = $faker->email." ".$faker->phoneNumber;
        $contactModel->type = "brother";
        $contactModel->save();
        $skills = Skill::find()->all();
        for($i=0;$i<rand(3,7);$i++){
        $model->link('skill',$skills[rand(0,7)]);

        }

                }
    }

}