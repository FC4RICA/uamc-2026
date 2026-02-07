import { initToggleSelect } from "../../components/toggleSelect";
import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";

document.addEventListener('DOMContentLoaded', () => {
    initToggleSelect(document);
    attachLoadingOnSubmit('edit-profile-form', '#submit-profile');
});