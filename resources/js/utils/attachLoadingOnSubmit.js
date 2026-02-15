export function attachLoadingOnSubmit(
    formId,
    buttonSelector
) {  
    const form = document.getElementById(formId);
    if (!form) return;

    const button = form.querySelector(buttonSelector);
    if (!button) return;

    const originalText = button.innerHTML;

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity() || button.disabled) {
            e.preventDefault();
            return;
        }

        button.disabled = true;
        button.setAttribute('aria-disabled', 'true');
        button.textContent = originalText + '...';

        setTimeout(() => {
            button.disabled = false;
            button.innerHTML = originalText;
        }, 10000);
    });

    form.addEventListener('reset', () => {
        button.disabled = false;
        button.innerHTML = originalText;
    });
}