<?php

namespace App\Http\Requests;

use App\Enums\SubmissionStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubmissionStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(SubmissionStatus::class)],
            'message' => [
                Rule::requiredIf(
                    fn () => $this->status === SubmissionStatus::REVISE_REQUIRED->value
                ),
                'string',
                'max:5000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'กรุณาระบุเหตุผลและสิ่งที่ต้องการให้แก้ไข',
        ];
    }
}
