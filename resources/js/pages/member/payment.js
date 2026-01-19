document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#submit-payment')
    .addEventListener('submit', e => {
        e.target.querySelector('button[type="submit"]').disabled = true;
    });
});