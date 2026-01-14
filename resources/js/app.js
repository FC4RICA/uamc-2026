import './bootstrap';
import 'bootstrap';
import '@popperjs/core';
import { initRegister } from './pages/register';

const bodyElement = document.body;
const pageValue = bodyElement.getAttribute('data-page');

switch (pageValue) {
    case 'register':
        initRegister();
        break;
    default:
        break;
}