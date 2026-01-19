import { initToggleSelect } from './toggleSelect';

export function initParticipant(participantEl) {
    initToggleSelect(participantEl);

    const removeBtn = participantEl.querySelector('.remove-participant');
    if (removeBtn) {
        removeBtn.addEventListener('click', () => {
            participantEl.remove();
        });
    }
}
