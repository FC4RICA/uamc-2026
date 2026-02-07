import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";

document.addEventListener('DOMContentLoaded', () => {
    attachLoadingOnSubmit('payment-form', '#submit-payment');
});