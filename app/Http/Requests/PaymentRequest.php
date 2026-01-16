<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->needsPayment();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_at' => ['required', 'date_format:Y-m-d\TH:i'],
            'account_name' => ['required', 'string', 'max:255'],
            'from_bank' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'max:2048'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'payment_datetime.required' => 'A title is required for your post.',
            'body.required' => 'The post body cannot be empty.',
        ];
    }
}
