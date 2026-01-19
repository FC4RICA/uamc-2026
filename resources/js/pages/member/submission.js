import { initParticipant } from '../../components/participant';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('#participants-container');
    const addBtn = document.querySelector('#add-participant');
    const template = document.querySelector('#participant-template');

    // init existing participants (old() / edit)
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

    document.querySelector('#submit-submission')
    .addEventListener('submit', e => {
        e.target.querySelector('button[type="submit"]').disabled = true;
    });

});

