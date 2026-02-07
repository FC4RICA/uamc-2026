export function attachConfirmOnSubmit(formId, message) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const confirmed = confirm(message);
        if (!confirmed) {
            e.preventDefault();
            e.stopImmediatePropagation();
        }
    });
}