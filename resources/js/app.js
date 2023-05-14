import './bootstrap';

import 'flowbite';

import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

FilePond.registerPlugin(FilePondPluginImagePreview);


import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.FilePond = FilePond;

Alpine.start();
