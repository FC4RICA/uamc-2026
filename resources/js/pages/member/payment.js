import { attachLoadingOnSubmit } from "../utils/form-loading";

document.addEventListener('DOMContentLoaded', () => {
    attachLoadingOnSubmit('payment-form', '#submit-payment');
});