import { initParticipant } from '../../components/participant';
import { attachLoadingOnSubmit } from "../../utils/attachLoadingOnSubmit";
import { attachConfirmOnSubmit } from '../../utils/attachConfirmOnSubmit';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('#participants-container');
    const addBtn = document.querySelector('#add-participant');
    const template = document.querySelector('#participant-template');

    const initialParticipantsHTML = container.innerHTML;

    container
        .querySelectorAll('[data-participant]')
        .forEach(initParticipant);

    addBtn.addEventListener('click', () => {
        const index = container.children.length;

        const html = template.innerHTML.replace(/__INDEX__/g, index);
        const wrapper = document.createElement('div');
        wrapper.innerHTML = html;

        const participant = wrapper.firstElementChild;
        container.appendChild(participant);

        initParticipant(participant);
    });

    attachLoadingOnSubmit('edit-submission-form', '#submit-edit-submission');

    attachConfirmOnSubmit('delete-submission-form', 'คุณแน่ใจหรือไม่ว่าต้องการลบบทคัดย่อนี้');
    attachLoadingOnSubmit('delete-submission-form', '#submit-delete-submission');

    const form = document.querySelector('#edit-submission-form');
    form.addEventListener('reset', () => {
        setTimeout(() => {
            container.innerHTML = initialParticipantsHTML;

            container
                .querySelectorAll('[data-participant]')
                .forEach(initParticipant);
        });
    });
});