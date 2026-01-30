import { initToggleSelect } from "../../components/toggleSelect";

document.addEventListener('DOMContentLoaded', () => {
    initToggleSelect(document);
    attachLoadingOnSubmit('edit-profile-form', '#submit-profile');
});