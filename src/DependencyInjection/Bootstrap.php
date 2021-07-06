<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use App\Filesystem\UrlGenerator;
use app\Model\Employee;
use app\Model\Skill;
use App\Model\TransactionManager;
use App\Repository\AREmployeeFamilyRepository;
use App\Repository\AREmployeeRepository;
use App\Repository\ARSkillRepository;
use App\Repository\EmployeeFamilyRepository;
use App\Repository\EmployeeRepository;
use App\Repository\SkillRepository;
use App\UseCase\EmployeeFamilyManagementService;
use App\UseCase\EmployeeManagementService;
use App\UseCase\SkillManagementService;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemWriter;
use League\Flysystem\Local\LocalFilesystemAdapter;
use yii\base\BootstrapInterface;
use yii\web\UrlManager;

final class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;
        $container->setSingleton(EmployeeFamilyManagementService::class);
        $container->setSingleton(EmployeeFamilyRepository::class, AREmployeeFamilyRepository::class);
        $container->setSingleton(EmployeeRepository::class,AREmployeeRepository::class);
        $container->setSingleton(SkillManagementService::class);
        $container->setSingleton(EmployeeManagementService::class);
        $container->setSingleton(SkillRepository::class,ARSkillRepository::class);
        $container->setSingleton(Filesystem::class, function () {
            $adapter = new LocalFilesystemAdapter(\dirname(__DIR__) . '/../web/storage');

            return new Filesystem($adapter);
        });
        $container->setSingleton(FilesystemWriter::class, Filesystem::class);
        $container->setSingleton(UrlManager::class, $app->urlManager);
        $container->setSingleton(UrlGenerator::class, UrlGenerator::class);
    }
}
