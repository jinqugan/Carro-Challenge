<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Str;

trait ResponseTrait
{

    /**
     * Generate successful response array.
     *
     * @return bool
     */
    public function requestResponses()
    {
        return [
            'data' => NULL,
        ];
    }

    /**
     * Generate fail response array.
     *
     * @param int $code
     * @param string $codeMsg
     * @param string $message
     * @param array $details
     * @return array
     */
    public function responseErrors(int $code = null, string $codeMsg = null, string $message = null, array $details = null): array
    {
        if ($code == null) {
            return ['errors' => null];
        }

        return [
            'errors' => [
                'code' => $code,
                'code_msg' => $codeMsg,
                'message' => $message,
                'details' => $details,
            ],
        ];
    }
}
