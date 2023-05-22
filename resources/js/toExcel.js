import * as XLSX from "./xlsx.full.min.js";

let btnExport = document.querySelector('#btn-export');

btnExport.addEventListener('click', ()=>{
    ExportToExcel('xlsx');
})

function ExportToExcel(type, fn, dl) {
    var d = Date();
    var filename = "SASExcelExport.";
    var elt = document.getElementById('printable');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || (filename + (type || 'xlsx')));
}