<?php

declare(strict_types=1);

function d(mixed ...$vars)
{
    foreach ($vars as $var) {
        \yii\helpers\VarDumper::dump($var, 10, true);
    }
}

function dd(mixed ...$vars)
{
    foreach ($vars as $var) {
        \yii\helpers\VarDumper::dump($var, 10, true);
    }
    exit;
}

function toBool(mixed $value): ?bool
{
    $result = null;
    if ('' === $value) {
        return null;
    }
    if ('false' === $value) {
        $result = false;
    } elseif ('true' === $value) {
        $result = true;
    } elseif (null !== $value && '' !== $value) {
        $result = (bool) $value;
    }

    return $result;
}

function env($key, $default = null)
{
    $value = getenv($key) ?? $_ENV[$key] ?? $_SERVER[$key];

    if (false === $value) {
        return $default;
    }
    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;
    }

    return $value;
}
