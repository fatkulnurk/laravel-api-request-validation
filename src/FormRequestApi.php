<?php
namespace Fatkulnurk\LaravelApiRequestValidation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

abstract class FormRequestApi extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Get the failed validation response for the request.
     *
     * @param array $errors
     * @param Request $request
     * @return JsonResponse
     */
    public function response(array $errors, Request $request)
    {
        $transformed = [];

        foreach ($errors as $field => $message) {
            $transformed[] = [
                'field' => $field,
                'message' => $message[0]
            ];
        }

        return response()->json([
            'errors' => $transformed,
            'old-value' => $request->all()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
