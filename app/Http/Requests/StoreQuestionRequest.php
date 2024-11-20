<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question' => 'required',
            // 'tags' => 'sometimes|nullable|string|max:255',
            'score' => 'sometimes|numeric|min:0|max:10',
            'course_id' => 'sometimes|nullable|integer|exists:courses,id',
            'certificate_id' => 'required|integer|exists:certificates,id',
        ];
    }
}
