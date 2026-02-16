import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";

document.addEventListener('DOMContentLoaded', () => {
    attachLoadingOnSubmit('revision-form', '#submit-revision');
});