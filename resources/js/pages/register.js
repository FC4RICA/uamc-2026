import { initToggleSelect } from "../components/toggleSelect";
import { attachLoadingOnSubmit } from "../utils/form-loading";

document.addEventListener('DOMContentLoaded', () => {
    initToggleSelect(document);
    attachLoadingOnSubmit('uploadPayment', '#submit-btn');
});
