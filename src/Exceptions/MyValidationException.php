<?php

namespace Bendt\Option\Throwables;

class MyValidationException extends \Throwable
{

    /**
     * Report or validation error an exception.
     *
     * @return \Illuminate\Http\Response
     */
    public function render($message)
    {
        $response = [
            'success' => false,
            'error' => json_decode($message),
        ];

        return response()->json($response, 422);
    }
}
