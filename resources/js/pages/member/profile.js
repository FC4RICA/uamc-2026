import { initToggleSelect } from "../../components/toggleSelect";
import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";
import { attachConfirmOnSubmit } from '../../utils/attachConfirmOnSubmit';

document.addEventListener('DOMContentLoaded', () => {
    initToggleSelect(document);
    attachConfirmOnSubmit('edit-profile-form', 'คุณแน่ใจหรือไม่ว่าต้องการแก้ไขข้อมูล');
    attachLoadingOnSubmit('edit-profile-form', '#submit-profile');
});