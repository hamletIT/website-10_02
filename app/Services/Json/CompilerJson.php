<?php

namespace App\Services\Json;

use App\Traits\Parameters;
use Illuminate\Http\JsonResponse;

class CompilerJson
{
    use Parameters;

    /**
     * Generate a JSON response with data, message, and code.
     *
     * @param mixed|null $data The data to include in the JSON response.
     * @param string|null $message The message to include in the JSON response.
     * @param int|null $code The code to include in the JSON response.
     * @return JsonResponse The JSON response object.
     */
    public function generator(mixed $data = null, string|null $message = null, int|null $code = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ]);
    }
}
