import './bootstrap';
import { initFlowbite } from 'flowbite';
import { alertConfirmation, alertSuccess, alertFailure } from './dashboard/sweetalert2';
import { filemanagerPicker } from './dashboard/laravel-filemanager';
import { tinymceTextarea } from './dashboard/tinymce';
import { select2select } from './dashboard/select2';

function initLibrary() {
    initFlowbite();
    tinymceTextarea();
    select2select();
}

// Listening DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    initLibrary();
    console.log('DOMContentLoaded');
});

// Listening livewire:navigated
document.addEventListener('livewire:navigated', () => {
    initLibrary();
    console.log('livewire:navigated');

});

// Listening livewire:init
document.addEventListener('livewire:init', () => {
    Livewire.on('alert-confirmation', (event) => {
        alertConfirmation(event);
    });

    Livewire.on('alert-success', (event) => {
        alertSuccess(event);
    });

    Livewire.on('alert-failure', (event) => {
        alertFailure(event);
    });

    Livewire.on('filemanager-picker', (event) => {
        filemanagerPicker(event);
    });

    Livewire.on('modal-refresh', () => {
        initLibrary();
    });
});
