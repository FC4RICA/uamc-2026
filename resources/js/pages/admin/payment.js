import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";
import { attachConfirmOnSubmit } from '../../utils/attachConfirmOnSubmit';

document.addEventListener('DOMContentLoaded', () => {
    attachConfirmOnSubmit('verify-payment-form', 'คุณแน่ใจหรือไม่ว่าต้องการยืนยันการชำระนี้');
    attachLoadingOnSubmit('verify-payment-form', '#submit-verify-payment');
    attachConfirmOnSubmit('reject-payment-form', 'คุณแน่ใจหรือไม่ว่าต้องการปฏิเสธการชำระนี้');
    attachLoadingOnSubmit('reject-payment-form', '#submit-reject-payment');
});