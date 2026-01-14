import { validateForm } from "../common/validateForm";
import toggleSelect from "../components/toggleSelect";

export function initRegister() {
    // registerValidate();

    document.addEventListener('DOMContentLoaded', () => {
        toggleSelect('occupation_id', 'occupation_other', 'other');
        toggleSelect('organization_id', 'organization_other', 'other');
        toggleSelect('participation_type', 'presentation_type_form_group', presenterId);
    });
}

function registerValidate() {
    const form = document.querySelector('form[name="registration"]')
    if (!form) return

    form.addEventListener('submit', (e) => {
        const isValid = validateForm(form, {
            email: [
                ['required', null, 'กรุณาใส่ข้อมูล'],
                ['email', null, 'email ควรอยู่ในรูปแบบ youremail@domain.domain'],
            ],
            password: [
                ['required', null, 'กรุณาใส่รหัสผ่าน'],
                ['minLength', 8, 'กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร'],
            ],
            confirmpassword: [
                ['equalTo', '#password', 'รหัสผ่านไม่ตรง'],
            ],
            firstname: [
                ['required', null, 'กรุณาระบุชื่อ'],
            ],
        })

        if (!isValid) e.preventDefault()
    })
}
