import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import * as FilePond from 'filepond';

window.FilePond = FilePond;

import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor'

document.addEventListener("DOMContentLoaded", function(event) {
    ClassicEditor
    .create(document.querySelector('.ckeditor'))
    .catch(error => {
        console.log(`error`, error)
    });
});


