import './bootstrap';

import 'flowbite';

import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

FilePond.registerPlugin(FilePondPluginImagePreview,
    FilePondPluginFileValidateType,
    FilePondPluginImageValidateSize,
    FilePondPluginFileValidateSize);

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.FilePond = FilePond;

Alpine.start();
