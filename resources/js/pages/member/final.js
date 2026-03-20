import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";

document.addEventListener('DOMContentLoaded', () => {
    attachLoadingOnSubmit('final-submission-form', '#submit-final-submission');

    attachLoadingOnSubmit('extended-abstract-form', '#submit-extended-abstract');
    attachLoadingOnSubmit('poster-form', '#submit-poster');
    attachLoadingOnSubmit('recommendation-letter-form', '#submit-recommendation-letter');
    attachLoadingOnSubmit('revised-abstract-form', '#submit-revised-abstract');
});