import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";
import { attachConfirmOnSubmit } from "../../utils/attachConfirmOnSubmit";

document.addEventListener('DOMContentLoaded', () => {
    attachConfirmOnSubmit('delete-submission-form', 'คุณแน่ใจหรือไม่ว่าต้องการลบบทคัดย่อนี้');
    attachLoadingOnSubmit('delete-submission-form', '#submit-delete-submission');
});