import './bootstrap';

import Alpine from 'alpinejs';
import { jsPDF } from "jspdf";
import $ from 'jquery';

import './printThis';
try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

window.Alpine = Alpine;

const doc = new jsPDF();
        $('#cmd').click(function () {

            $('#print').printThis({
                header: null,                   // prefix to html
                footer: null,
            });
        });

Alpine.start();
