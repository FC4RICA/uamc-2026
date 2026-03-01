document.addEventListener("DOMContentLoaded", function () {

    const pdpaBox = document.getElementById('pdpa-box');

    if (!pdpaBox) return;

    const consent = localStorage.getItem('acceptCookie');

    function showPdpaBox() {
        pdpaBox.classList.remove('d-none');
    }

    function hidePdpaBox() {
        pdpaBox.classList.add('d-none');
    }

    if (consent === 'accepted' || consent === 'denied') {
        hidePdpaBox();
    } else {
        showPdpaBox();
    }

    // Attach button events
    const acceptBtn = pdpaBox.querySelector('.btn-warning');
    const denyBtn = pdpaBox.querySelector('.btn-outline-warning');

    if (acceptBtn) {
        acceptBtn.addEventListener('click', function () {
            localStorage.setItem('acceptCookie', 'accepted');
            hidePdpaBox();
        });
    }

    if (denyBtn) {
        denyBtn.addEventListener('click', function () {
            localStorage.setItem('acceptCookie', 'denied');
            hidePdpaBox();
        });
    }

});