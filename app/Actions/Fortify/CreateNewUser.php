<?php

namespace App\Actions\Fortify;

use App\Data\ProfileData;
use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Models\Occupation;
use App\Models\Organization;
use App\Models\Profile;
use App\Models\User;
use App\Services\AccessControl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        if (!AccessControl::registrationOpen()) {
            throw ValidationException::withMessages([
                'message' => 'Registration is currently closed.',
            ]);
        }

        $rules = $this->rules($input);
        if (($input['organization_id'] ?? null) === 'other') {
            $rules['organization_id'][] = Rule::in(['other']);
        } else {
            $rules['organization_id'][] = Rule::exists(Organization::class, 'id');
        }

        if (($input['occupation_id'] ?? null) === 'other') {
            $rules['occupation_id'][] = Rule::in(['other']);
        } else {
            $rules['occupation_id'][] = Rule::exists(Occupation::class, 'id');
        }

        Validator::make(
            $input,
            $rules,
            $this->messages(),
        )->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'payment_required' => $input['organization_id'] === 'other',
            ]);

            $profileData = array_merge(
                ProfileData::normalize($input),
                [
                    'user_id' => $user->id,
                    'firstname' => $input['firstname'],
                    'lastname' => $input['lastname'],
                    'phone' => $input['phone'],
                    'special_requirements' => $input['special_requirements'],
                    'title' => $input['title'],
                    'academic_title' => $input['academic_title'],
                    'education' => $input['education'],
                    'participation_type' => $input['participation_type'],
                    'created_by' => $user->id,
                ]
            );

            Profile::create($profileData);

            return $user;
        });
    }

    private function rules(array $input): array
    {
        $isPresenter = ($input['participation_type'] ?? null) == ParticipationType::PRESENTER->value;

        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'string', 'max:255'],
            'special_requirements' => ['nullable'],
            'title' => ['required', Rule::enum(Title::class)],
            'academic_title' => ['required', Rule::enum(AcademicTitle::class)],
            'education' => ['required', Rule::enum(Education::class)],
            'participation_type' => ['required', Rule::enum(ParticipationType::class)],
            'presentation_type' => [
                Rule::requiredIf($isPresenter),
                Rule::when(
                    $isPresenter, 
                    Rule::enum(PresentationType::class)
                ),
                'nullable',
            ],
            'organization_id' => [
                'required',
            ],
            'organization_other' => [
                Rule::requiredIf(fn () => ($input['organization_id'] ?? null) === 'other'),
                'nullable',
                'string',
                'max:255',
            ],
            'occupation_id' => [
                'required',
            ],
            'occupation_other' => [
                Rule::requiredIf(fn () => ($input['occupation_id'] ?? null) === 'other'),
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    private function messages(): array
    {
        return [
            'firstname.required' => 'กรุณากรอกชื่อ',
            'firstname.max' => 'ชื่อยาวเกิน 255 ตัวอักษร',

            'lastname.required' => 'กรุณากรอกนามสกุล',
            'lastname.max' => 'นามสกุลยาวเกิน 255 ตัวอักษร',

            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.max' => 'อีเมลยาวเกิน 255 ตัวอักษร',
            'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',

            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.confirmed' => 'การยืนยันรหัสผ่านไม่ตรงกัน',
            'password.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย :min ตัวอักษร',

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

            'occupation_id.required' => 'กรุณาเลือกอาชีพ',
            'occupation_id.exists' => 'อาชีพที่เลือกไม่ถูกต้อง',
            'occupation_id.in' => 'อาชีพที่เลือกไม่ถูกต้อง',
            'occupation_other.required' => 'กรุณาระบุอาชีพ',
            'occupation_other.string' => 'ชื่ออาชีพไม่ถูกต้อง',
            'occupation_other.max' => 'ชื่ออาชีพยาวเกิน 255 ตัวอักษร',
        ];
    }
}
