<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

trait WithPerPage
{
    protected static int $defaultPerPage = 20;
    protected static int $maxPerPage = 100;

    public function getPerPage(Request $request): int
    {
        $validated = $request->validate([
            'per_page' => [
                'sometimes',
                'integer',
                'min:1',
                'max:' . static::$maxPerPage
            ]
        ]);

        return (int) ($validated['per_page'] ?? static::$defaultPerPage);
    }
}
