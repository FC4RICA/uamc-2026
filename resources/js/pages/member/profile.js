import { initToggleSelect } from "../../components/toggleSelect";
import { attachLoadingOnSubmit } from "../../utils/form-loading";

document.addEventListener('DOMContentLoaded', () => {
    initToggleSelect(document);
    attachLoadingOnSubmit('edit-profile-form', '#submit-profile');
});