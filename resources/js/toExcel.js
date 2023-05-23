import * as  XLSX from 'xlsx'

let btnExport = document.querySelector('#btn-export');

btnExport && btnExport.addEventListener('click', ()=>{
    ExportToExcel('xlsx');
    console.log(document.title)
})

function ExportToExcel(type, fn, dl) {
    var d = new Date();
    // console.log(d.getUTCDate())
    var filename = document.title;
    var elt = document.getElementById('printable');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || (filename +'.'+ (type || 'xlsx')));
}