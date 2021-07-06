<?php

declare(strict_types=1);

namespace App\Definitions;

/**
 * @OA\Schema(
 *     @OA\Property(property="totalCount", type="integer"),
 *     @OA\Property(property="pageCount", type="integer"),
 *     @OA\Property(property="currentPage", type="integer"),
 *     @OA\Property(property="perPage", type="integer"),
 * )
 */
final class Meta
{
}
