import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";
import { attachConfirmOnSubmit } from "../../utils/attachConfirmOnSubmit";

document.addEventListener('DOMContentLoaded', () => {
    attachConfirmOnSubmit('accept-submission-form', 'คุณแน่ใจหรือไม่ว่าต้องการยอมรับบทคัดย่อนี้');
    attachLoadingOnSubmit('accept-submission-form', '#submit-accept-submission');

    attachConfirmOnSubmit('reject-submission-form', 'คุณแน่ใจหรือไม่ว่าต้องการขอปรับปรุงบทคัดย่อนี้');
    attachLoadingOnSubmit('reject-submission-form', '#submit-reject-submission');

    attachConfirmOnSubmit('revise-submission-form', 'คุณแน่ใจหรือไม่ว่าต้องการปฏิเสธบทคัดย่อนี้');
    attachLoadingOnSubmit('revise-submission-form', '#submit-revise-submission');

    attachConfirmOnSubmit('pending-submission-form', 'คุณแน่ใจหรือไม่ว่าต้องย้อนสถานะบทคัดย่อนี้');
    attachLoadingOnSubmit('pending-submission-form', '#submit-pending-submission');

    attachConfirmOnSubmit('delete-submission-form', 'คุณแน่ใจหรือไม่ว่าต้องการลบบทคัดย่อนี้');
    attachLoadingOnSubmit('delete-submission-form', '#submit-delete-submission');
});