import { initToggleSelect } from "../../components/toggleSelect";
import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";
import { attachConfirmOnSubmit } from '../../utils/attachConfirmOnSubmit';

document.addEventListener('DOMContentLoaded', () => {
    attachConfirmOnSubmit('edit-user-form', 'คุณแน่ใจหรือไม่ว่าต้องการแก้ไขอีเมลผู้ใช้');
    attachLoadingOnSubmit('edit-user-form', '#submit-edit-user');
    attachConfirmOnSubmit('delete-user-form', 'คุณแน่ใจหรือไม่ว่าต้องการปิดการใช้งานบัญชี');
    attachLoadingOnSubmit('delete-user-form', '#submit-delete-user');
});