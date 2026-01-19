export function initToggleSelect(root = document) {
    const selects = root.querySelectorAll('[data-toggle-select]');
    

    selects.forEach(select => {
        const target = root.querySelector(select.dataset.target);
        if (!target) return;

        const targetValue = select.dataset.value;
        const targetLabel = root.querySelector(target.dataset.label);

        const update = () => {
            const active = select.value === targetValue;

            target.classList.toggle('d-none', !active);
            target.required = active;

            if (targetLabel) targetLabel.classList.toggle('d-none', !active);

            if (!active) target.value = '';
        };

        select.addEventListener('change', update);
        update();
    });
}