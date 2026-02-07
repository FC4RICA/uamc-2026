import { initToggleSelect } from "../components/toggleSelect";
import { attachLoadingOnSubmit } from "../utils/attachLoadingOnSubmit";

document.addEventListener('DOMContentLoaded', () => {
    initToggleSelect(document);
    attachLoadingOnSubmit('uploadPayment', '#submit-btn');
});
