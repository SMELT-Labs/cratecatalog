import './bootstrap';
import Alpine from 'alpinejs';
import compose from 'lodash/fp/compose';

window.Alpine = Alpine;
window.compose = compose
Alpine.start();

