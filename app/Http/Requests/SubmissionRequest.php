<?php

namespace App\Http\Requests;

use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\Title;
use App\Models\AbstractGroup;
use App\Models\Occupation;
use App\Models\Organization;
use App\Models\Submission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Submission::class) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'groups'     => ['required', 'array'],
            'groups.1'   => ['required', Rule::exists(AbstractGroup::class, 'id')],
            'groups.2'   => ['nullable', Rule::exists(AbstractGroup::class, 'id')],
            'groups.3'   => ['nullable', Rule::exists(AbstractGroup::class, 'id')],
            'groups.*'   => ['distinct'],

            'title_th' => ['required', 'string', 'max:65535'],
            'title_en' => ['required', 'string', 'max:65535'],
            'keyword' => ['required', 'string', 'max:65535'],

            'abstract_th' => ['required', 'file', 'mimes:pdf', 'max:51200'],
            'abstract_en' => ['required', 'file', 'mimes:pdf', 'max:51200'],
            'poster' => [
                Rule::requiredIf(fn () => (Auth::user()->isPoster())),
                'file',
                'mimes:pdf',
                'max:51200'
            ],

            'participants.*.firstname' => ['required', 'string', 'max:255'],
            'participants.*.lastname' => ['required', 'string', 'max:255'],
            'participants.*.phone' => ['nullable', 'string', 'max:255'],
            'participants.*.special_requirements' => ['nullable'],
            'participants.*.title' => ['required', Rule::enum(Title::class)],  
            'participants.*.academic_title' => ['required', Rule::enum(AcademicTitle::class)],
            'participants.*.education' => ['required', Rule::enum(Education::class)],

            'participants.*.organization_id' => [
                'required',
                Rule::when(
                    fn ($value) => $value !== 'other',
                    Rule::exists(Organization::class, 'id'),
                    Rule::in(['other'])
                ),
            ],
            'participants.*.organization_other' => [
                'required_if:participants.*.organization_id,other',
                'nullable',
                'string',
                'max:255',
            ],

            'participants.*.occupation_id' => [
                'required',
                Rule::when(
                    fn ($value) => $value !== 'other',
                    Rule::exists(Occupation::class, 'id'),
                    Rule::in(['other'])
                ),
            ],
            'participants.*.occupation_other' => [
                'required_if:participants.*.occupation_id,other',
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            // group
            'groups.required'       => 'กรุณาเลือกกลุ่มบทคัดย่อหลัก',
            'groups.1.required'     => 'กรุณาเลือกกลุ่มบทคัดย่อหลัก',
            'groups.*.distinct'     => 'กรุณาเลือกกลุ่มบทคัดย่อที่ไม่ซ้ำกัน',
            'groups.*.exists'       => 'กลุ่มบทคัดย่อที่เลือกไม่ถูกต้อง',

            // Titles & abstracts
            'title_th.required' => 'กรุณากรอกชื่อบทคัดย่อภาษาไทย',
            'title_th.string' => 'ชื่อบทคัดย่อภาษาไทยต้องเป็นข้อความ',
            'title_th.max' => 'ชื่อบทคัดย่อภาษาไทยยาวเกินกำหนด',

            'title_en.required' => 'กรุณากรอกชื่อบทคัดย่อภาษาอังกฤษ',
            'title_en.string' => 'ชื่อบทคัดย่อภาษาอังกฤษต้องเป็นข้อความ',
            'title_en.max' => 'ชื่อบทคัดย่อภาษาอังกฤษยาวเกินกำหนด',

            'keyword.required' => 'กรุณากรอกคำสำคัญ',
            'keyword.string' => 'คำสำคัญต้องเป็นข้อความ',
            'keyword.max' => 'คำสำคัญยาวเกินกำหนด',

            'abstract_th.required' => 'กรุณาอัปโหลดไฟล์บทคัดย่อภาษาไทย',
            'abstract_th.file' => 'ไฟล์บทคัดย่อภาษาไทยไม่ถูกต้อง',
            'abstract_th.mimes' => 'ไฟล์บทคัดย่อภาษาไทยต้องเป็นไฟล์ PDF เท่านั้น',
            'abstract_th.max' => 'ไฟล์บทคัดย่อภาษาไทยต้องมีขนาดไม่เกิน 50 MB',

            'abstract_en.required' => 'กรุณาอัปโหลดไฟล์บทคัดย่อภาษาอังกฤษ',
            'abstract_en.file' => 'ไฟล์บทคัดย่อภาษาอังกฤษไม่ถูกต้อง',
            'abstract_en.mimes' => 'ไฟล์บทคัดย่อภาษาอังกฤษต้องเป็นไฟล์ PDF เท่านั้น',
            'abstract_en.max' => 'ไฟล์บทคัดย่อภาษาอังกฤษต้องมีขนาดไม่เกิน 50 MB',

            // Poster
            'poster.required' => 'กรุณาอัปโหลดไฟล์โปสเตอร์',
            'poster.file' => 'ไฟล์โปสเตอร์ไม่ถูกต้อง',
            'poster.mimes' => 'ไฟล์โปสเตอร์ต้องเป็นไฟล์ PDF เท่านั้น',
            'poster.max' => 'ไฟล์โปสเตอร์ต้องมีขนาดไม่เกิน 50 MB',

            // Participants (generic)
            'participants.*.firstname.required' => 'กรุณากรอกชื่อจริงของผู้ร่วมเขียน',
            'participants.*.firstname.string' => 'ชื่อจริงของผู้ร่วมเขียนต้องเป็นข้อความ',
            'participants.*.firstname.max' => 'ชื่อจริงของผู้ร่วมเขียนยาวเกินกำหนด',

            'participants.*.lastname.required' => 'กรุณากรอกนามสกุลของผู้ร่วมเขียน',
            'participants.*.lastname.string' => 'นามสกุลของผู้ร่วมเขียนต้องเป็นข้อความ',
            'participants.*.lastname.max' => 'นามสกุลของผู้ร่วมเขียนยาวเกินกำหนด',

            // 'participants.*.phone.required' => 'กรุณากรอกหมายเลขโทรศัพท์ของผู้ร่วมเขียน',
            'participants.*.phone.string' => 'หมายเลขโทรศัพท์ของผู้ร่วมเขียนต้องเป็นข้อความ',
            'participants.*.phone.max' => 'หมายเลขโทรศัพท์ของผู้ร่วมเขียนยาวเกินกำหนด',

            // Enums
            'participants.*.title.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'participants.*.title.enum' => 'คำนำหน้าชื่อที่เลือกไม่ถูกต้อง',

            'participants.*.academic_title.required' => 'กรุณาเลือกตำแหน่งทางวิชาการ',
            'participants.*.academic_title.enum' => 'ตำแหน่งทางวิชาการที่เลือกไม่ถูกต้อง',

            'participants.*.education.required' => 'กรุณาเลือกระดับการศึกษา',
            'participants.*.education.enum' => 'ระดับการศึกษาที่เลือกไม่ถูกต้อง',

            // Organization
            'participants.*.organization_id.required' => 'กรุณาเลือกหน่วยงาน',
            'participants.*.organization_id.exists' => 'หน่วยงานที่เลือกไม่ถูกต้อง',
            'participants.*.organization_id.in' => 'หน่วยงานที่เลือกไม่ถูกต้อง',
            'participants.*.organization_id.exists' => 'หน่วยงานที่เลือกไม่ถูกต้อง',
            'participants.*.organization_other.required_if'
                => 'กรุณาระบุชื่อหน่วยงาน เมื่อเลือก "อื่น ๆ"',
            'participants.*.organization_other.string'
                => 'ชื่อหน่วยงานต้องเป็นข้อความ',
            'participants.*.organization_other.max'
                => 'ชื่อหน่วยงานยาวเกินกำหนด',

            // Occupation
            'participants.*.occupation_id.required' => 'กรุณาเลือกอาชีพ',
            'participants.*.occupation_id.exists' => 'อาชีพที่เลือกไม่ถูกต้อง',
            'participants.*.occupation_id.in' => 'อาชีพที่เลือกไม่ถูกต้อง',
            'participants.*.occupation_other.required_if'
                => 'กรุณาระบุอาชีพ เมื่อเลือก "อื่น ๆ"',
            'participants.*.occupation_other.string'
                => 'ชื่ออาชีพต้องเป็นข้อความ',
            'participants.*.occupation_other.max'
                => 'ชื่ออาชีพยาวเกินกำหนด',
        ];
    }

}
