export default function toggleSelect (selectId, inputId, targetValue) {
    const select = document.getElementById(selectId);
    const input  = document.getElementById(inputId);

    if (!select || !input) return;

    const update = () => {
        if (select.value == targetValue) {
            input.classList.remove('d-none');
            input.required = true;
        } else {
            input.classList.add('d-none');
            input.required = false;
            input.value = '';
        }
    };

    select.addEventListener('change', update);
    update(); // run once on page load (for validation errors)
}