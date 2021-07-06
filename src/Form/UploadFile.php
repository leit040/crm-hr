<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model\BaseModel;
use yii\web\UploadedFile;

/**
 * @OA\Schema(
 *     required={"file"},
 *     title="Upload file form"
 *
 * )
 */
final class UploadFile extends BaseModel
{
    /**
     * @OA\Property(property="file", type="string", format="binary")
     */
    public ?UploadedFile $file;

    public function rules(): array
    {
        return [
            ['file', 'required'],
            [['file'], 'file'],
        ];
    }
}
