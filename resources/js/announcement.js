import * as bootstrap from 'bootstrap';

document.addEventListener("DOMContentLoaded", function () {

    const noticeVersion = "submission_notice";
    const alreadyShown = localStorage.getItem(noticeVersion);

    const modalElement = document.getElementById('submissionUpdateModal');

    if (modalElement && !alreadyShown) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();

        modalElement.addEventListener('hidden.bs.modal', function () {
            localStorage.setItem(noticeVersion, "shown");
        });
    }
    

});