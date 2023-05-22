<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class ImportExcelController extends Controller
{

    public function index()
    {
        return view('eleve.excel')->with('page_name', 'Import Excel');
    }

    public function import(Request $request)
    {   
        $request->validate([
            'excel_file' => ['required', 'file', 'mimes:xlsx,xlsm,csv', 'max:5000']
        ]);
        $file = $request->file('excel_file');

        // dd($file);

        if($file->isValid()){
            $path = $file->path();
            $spreadsheeet = IOFactory::load($path);

            $worksheet = $spreadsheeet->getActiveSheet();
            
            ///ping firstrow
            // $rowData = []; // Array to store the cell values in the row

            // $rowIndex = 1 ;

            // // $row = $spreadsheeet->getActiveSheet()->getRow($rowIndex); // Get the row object

            // // $highestColumn = $worksheet->getHighestColumn(); // Get the highest column in the row
            // // $columnIterator = $worksheet->getColumnIterator(); // Get the column iterator

            // // foreach ($columnIterator as $column) {
            // //     $columnLetter = $column->getColumnIndex(); // Get the column letter (e.g., 'A', 'B', 'C', ...)
            // //     $cellValue = $worksheet->getCell($columnLetter . $rowIndex)->getValue(); // Get the cell value

            // //     $rowData[] = $cellValue; // Store the cell value in the row data array
            // // }

            // $row = $worksheet->getCellCollection()->getRow($rowIndex);
            // dd($row);
            // // foreach($row as $cell){

            // // }

            // dd($rowData);

            $data = [];
            $highestrow = $worksheet->getHighestRow();
            // dd($worksheet->getRowIterator(1)->current());

            foreach($worksheet->getRowIterator(1) as $row){
                foreach($row->getCellIterator() as $cell){
                    $data[] = $cell->getValue();
                    // $data[] = array_map('trim', $row->toArray());
                }
            }

            dd($data);

        }else{
            dd(101);
        }
    }
}