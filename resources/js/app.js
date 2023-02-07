import "./delete";
import "./bootstrap";
import "./myjs";
import "./fa.min";
import "./countup";
//import './Chart.extension';
import "./chartjs.min";
import "./charts";
import "./perfect-scrollbar.min";
import "./sidenav-burger";
import "./perfect-scrollbar";
import "./argon-dashboard-tailwind";

import "./popper";
import Alpine from "alpinejs";
import { jsPDF } from "jspdf";
import $ from "jquery";

import "./printThis";

try {
    window.$ = window.jQuery = require("jquery");
} catch (e) {}

window.Alpine = Alpine;

const doc = new jsPDF();
$("#cmd").click(function () {
    $("#print").printThis({
        header: null, // prefix to html
        footer: null,
    });
});

Alpine.start();
