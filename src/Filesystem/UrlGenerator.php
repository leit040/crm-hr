<?php

declare(strict_types=1);

namespace App\Filesystem;

use yii\web\UrlManager;

class UrlGenerator
{
    private UrlManager $urlManager;

    public function __construct(UrlManager $urlManager)
    {
        $this->urlManager = $urlManager;
    }

    public function getPublicUrl(string $path): string
    {
        return $this->urlManager->createAbsoluteUrl('/storage' . $path);
    }
}
