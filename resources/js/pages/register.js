import { validateForm } from "../common/validateForm";
import { initToggleSelect } from "../components/toggleSelect";

document.addEventListener('DOMContentLoaded', () => {
    initToggleSelect(document);
});

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
