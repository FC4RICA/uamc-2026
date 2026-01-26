<?php

namespace App\Http\Requests;

use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Models\Occupation;
use App\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'special_requirements' => ['nullable'],
            'title' => ['required', Rule::enum(Title::class)],
            'academic_title' => ['required', Rule::enum(AcademicTitle::class)],
            'education' => ['required', Rule::enum(Education::class)],
            'participation_type' => [
                'required',
                Rule::enum(ParticipationType::class),
                function ($attr, $value, $fail) {
                    if ($this->user()->hasSubmission()) {
                        $fail('You cannot change participation type after submitting.');
                    }
                },
            ],
            'presentation_type' => [
                Rule::requiredIf(fn () => ($input['participation_type'] ?? null) == ParticipationType::PRESENTER->value),
                Rule::when(
                    ($input['participation_type'] ?? null) == ParticipationType::PRESENTER->value, 
                    Rule::enum(PresentationType::class)
                ),
                'nullable',
                function ($attr, $value, $fail) {
                    if ($this->user()->hasSubmission()) {
                        $fail('You cannot change presentation type after submitting.');
                    }
                },
            ],
            'organization_id' => [
                'required',
                Rule::when(
                    fn ($value) => $value !== 'other',
                    Rule::exists(Organization::class, 'id'),
                    Rule::in(['other'])
                ),
            ],
            'organization_other' => [
                'required_if:organization_id,other',
                'nullable',
                'string',
                'max:255',
            ],
            'occupation_id' => [
                'required',
                Rule::when(
                    fn ($value) => $value !== 'other',
                    Rule::exists(Occupation::class, 'id'),
                    Rule::in(['other'])
                ),
            ],
            'occupation_other' => [
                'required_if:occupation_id,other',
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'กรุณากรอกชื่อ',
            'firstname.max' => 'ชื่อยาวเกิน 255 ตัวอักษร',

            'lastname.required' => 'กรุณากรอกนามสกุล',
            'lastname.max' => 'นามสกุลยาวเกิน 255 ตัวอักษร',

            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'phone.string' => 'เบอร์โทรศัพท์ไม่ถูกต้อง',
            'phone.max' => 'เบอร์โทรศัพท์ยาวเกิน 255 ตัวอักษร',

            'title.required' => 'กรุณาเลือกคำนำหน้า',
            'title.enum' => 'คำนำหน้าที่เลือกไม่ถูกต้อง',

            'academic_title.required' => 'กรุณาเลือกตำแหน่งทางวิชาการ',
            'academic_title.enum' => 'ตำแหน่งทางวิชาการที่เลือกไม่ถูกต้อง',

            'education.required' => 'กรุณาเลือกระดับการศึกษา',
            'education.enum' => 'ระดับการศึกษาที่เลือกไม่ถูกต้อง',

            'participation_type.required' => 'กรุณาเลือกประเภทการเข้าร่วม',
            'participation_type.enum' => 'ประเภทการเข้าร่วมไม่ถูกต้อง',

            'presentation_type.required' => 'กรุณาเลือกประเภทการนำเสนอ',
            'presentation_type.enum' => 'ประเภทการนำเสนอไม่ถูกต้อง',

            'organization_id.required' => 'กรุณาเลือกหน่วยงาน / สถานที่ทำงาน',
            'organization_id.exists' => 'หน่วยงานที่เลือกไม่ถูกต้อง',
            'organization_id.in' => 'หน่วยงานที่เลือกไม่ถูกต้อง',
            'organization_other.required' => 'กรุณาระบุหน่วยงาน / สถานที่ทำงาน',
            'organization_other.string' => 'ชื่อหน่วยงานไม่ถูกต้อง',
            'organization_other.max' => 'ชื่อหน่วยงานยาวเกิน 255 ตัวอักษร',
            'organization_other.required_if'
                => 'กรุณาระบุชื่อหน่วยงาน เมื่อเลือก "อื่น ๆ"',

            'occupation_id.required' => 'กรุณาเลือกอาชีพ',
            'occupation_id.exists' => 'อาชีพที่เลือกไม่ถูกต้อง',
            'occupation_id.in' => 'อาชีพที่เลือกไม่ถูกต้อง',
            'occupation_other.required' => 'กรุณาระบุอาชีพ',
            'occupation_other.string' => 'ชื่ออาชีพไม่ถูกต้อง',
            'occupation_other.max' => 'ชื่ออาชีพยาวเกิน 255 ตัวอักษร',
            'occupation_other.required_if'
                => 'กรุณาระบุอาชีพ เมื่อเลือก "อื่น ๆ"',
        ];
    }
}
