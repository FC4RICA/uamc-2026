<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Payment::class) ?? false;
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
            'file' => ['required', 'file', 'max:2048', 'image'],
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
            'payment_at.required' => 'กรุณาระบุวันที่และเวลาที่โอนเงิน',
            'payment_at.date_format' => 'รูปแบบวันที่และเวลาไม่ถูกต้อง',

            'account_name.required' => 'กรุณาระบุชื่อบัญชีผู้โอน',
            'account_name.string' => 'ชื่อบัญชีผู้โอนต้องเป็นข้อความ',
            'account_name.max' => 'ชื่อบัญชีผู้โอนไม่ควรยาวเกิน 255 ตัวอักษร',

            'from_bank.required' => 'กรุณาระบุชื่อธนาคารที่โอนเงิน',
            'from_bank.string' => 'ชื่อธนาคารต้องเป็นข้อความ',
            'from_bank.max' => 'ชื่อธนาคารไม่ควรยาวเกิน 255 ตัวอักษร',

            'file.required' => 'กรุณาอัพโหลดหลักฐานการชำระเงิน',
            'file.file' => 'ไฟล์ที่อัพโหลดไม่ถูกต้อง',
            'file.image' => 'ไฟล์หลักฐานต้องเป็นรูปภาพเท่านั้น (jpg, png)',
            'file.max' => 'ขนาดไฟล์ต้องไม่เกิน 2 MB',
        ];
    }
}
