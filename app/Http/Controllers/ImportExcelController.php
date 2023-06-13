<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class ImportExcelController extends Controller
{

    public function index()
    {
        // dd(Eleve::getLastMatricule());
        return view("eleve.excel")->with('page_name', 'Import Excel');
    }

    public function importEleves(Request $request)
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

            $headers = [];
            $datas = [];
            $highestrow = $worksheet->getHighestRow();
            // dd($worksheet->getRowIterator(1)->current());
            
            //headers
              foreach($worksheet->getRowIterator(1,1) as $row){
                // dd($row);
                foreach($row->getCellIterator() as $cell){
                    // if($cell->getValue() !== null){
                    $headers[] = $cell->getValue();
                    // }
                    // $data[] = array_map('trim', $row->toArray());
                }
            }
            // dd(str_contains((strtolower($headers[0])), 'nom') );
            // check headers
            // if(count($headers) > 7){
            //     if ((str_contains((strtolower($headers[0])), 'nom') || str_contains((strtolower($headers[0])), 'post-nom') || str_contains((strtolower($headers[0])), 'postnom')) &&
            //         (str_contains((strtolower($headers[1])), 'prenom') || str_contains((strtolower($headers[1])), 'prénom')) &&
            //         (str_contains((strtolower($headers[2])), 'sexe')) && 
            //         (str_contains((strtolower($headers[3])), 'lieu') || str_contains((strtolower($headers[3])), 'naissance')) &&
            //         (str_contains((strtolower($headers[4])), 'date') || str_contains((strtolower($headers[4])), 'naissance')) &&
            //         (str_contains((strtolower($headers[5])), 'nom') || str_contains((strtolower($headers[5])), 'pere') || str_contains((strtolower($headers[5])), 'père')) &&
            //         (str_contains((strtolower($headers[6])), 'nom') || str_contains((strtolower($headers[6])), 'mere') || str_contains((strtolower($headers[6])), 'mère')) &&
            //         (str_contains((strtolower($headers[7])), 'adresse') || str_contains((strtolower($headers[7])), 'domicile'))
            //     ) {
            //         dd('passed');
            //     }
            // }
            // dd('not passed');

            $nom = '';
            $prenom = '';
            $sexe = '';
            $lieu = '';
            $date = '';
            $pere = '';
            $mere = '';
            $adresse = '';
            //check headers v2
            foreach ($headers as $index => $header) {
                if (str_contains((strtolower($header)), 'nom,postnom') || str_contains((strtolower($header)), 'nom et postnom') || (str_contains((strtolower($header)), 'nom,post-nom') || str_contains((strtolower($header)), 'nom et post-nom') || str_contains((strtolower($header)), 'post-nom') || str_contains((strtolower($header)), 'postnom'))){
                    $nom = $index;
                }else{
                    if(str_contains((strtolower($header)), 'prenom') || str_contains((strtolower($header)), 'prénom')){
                        $prenom = $index;
                    }else{
                        if(str_contains((strtolower($header)), 'sexe')){
                            $sexe = $index;
                        }else{
                            if(str_contains((strtolower($header)), 'lieu') || str_contains((strtolower($header)), 'lieu de naissance') || str_contains((strtolower($header)), 'lieu, naissance')){
                                $lieu = $index;
                            }else{
                                if(str_contains((strtolower($header)), 'date') || str_contains((strtolower($header)), 'date de naissance') || str_contains((strtolower($header)), 'date naissance') || (str_contains((strtolower($header)), 'lieu') && str_contains((strtolower($header)), 'naissance'))){
                                    $date = $index;
                                }else{
                                    if((str_contains((strtolower($header)), 'nom') && str_contains((strtolower($header)), 'pere')) || (str_contains((strtolower($header)), 'père') && str_contains((strtolower($header)), 'nom'))){
                                        $pere = $index;
                                    }else{
                                        if((str_contains((strtolower($header)), 'nom') && str_contains((strtolower($header)), 'mere')) || (str_contains((strtolower($header)), 'mère') && str_contains((strtolower($header)), 'nom')) || str_contains((strtolower($header)), 'mere') || str_contains((strtolower($header)), 'mère')){
                                            $mere = $index;
                                        }else{
                                            if(str_contains((strtolower($header)), 'adresse') || str_contains((strtolower($header)), 'domicile')){
                                                $adresse = $index;
                                            }

                                        }

                                    }

                                }

                            }

                        }
                    
                    }
                }

            }
            // dd(
            //     $nom,
            //     $prenom,
            //     $sexe,
            //     $lieu,
            //     $date,
            //     $pere,
            //     $mere,
            //     $adresse,
            // );

            if(
                $nom !== '' &&
                $prenom !== '' &&
                $sexe !== '' &&
                $lieu !== '' &&
                $date !== '' &&
                $pere !== '' &&
                $mere !== '' &&
                $adresse !== ''
            ){
                //datas
                foreach($worksheet->getRowIterator(2) as $row){
                    $data = [];
                    foreach($row->getCellIterator() as $cell){
                        // if($cell->getValue() !== null){
                        $data[] = $cell->getValue();
                        // }
                        // $data[] = array_map('trim', $row->toArray());
                    }
                    $datas[] = $data;
                    // array_push($datas, $data);
                }

                $eleves = [];
                foreach($datas as $data){
                    if ($data[$nom] !== null && $data[$prenom] !== null && $data[$sexe] !== null && $data[$lieu] !== null && $data[$date] !== null && $data[$pere] !== null && $data[$mere] !== null && $data[$adresse] !== null) {
                        $eleve = [];
                        $eleve['nom'] = $data[$nom] !== null ? $data[$nom] : 'uiok';
                        $eleve['prenom'] = $data[$prenom];
                        $eleve['sexe'] = $data[$sexe];
                        $eleve['lieu'] = $data[$lieu];
                        if (is_int($data[$date])) {
                            # code...
                            $dat = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data[$date]);
                            $eleve['date'] = $dat->format('Y-m-d');
                        }else{
                            if ($data[$date] !== null ) {
                                # code...
                                $eleve['date_error'] = $data[$date];
                                $dateError = true;
                            }
                            // dd($data[$date]);
                        }
                        $eleve['pere'] = $data[$pere];
                        $eleve['mere'] = $data[$mere];
                        $eleve['adresse'] = $data[$adresse];
                        $eleves[] = $eleve;
                    }
                }
                
                $request->session()->put('importedEleves', $eleves);

                if(isset($dateError)){
                    
                    return redirect()->back()
                    ->with(['data' => $eleves])
                    ->withErrors([
                        'file' => 'Erreur dans le fichier, assurez vous que toutes les dates de naissances sont bien écrites et  respectent le format  : 2002-01-12'
                    ]);
                }
                return view("eleve.excel")
                        
                        ->with('page_name', 'Import Excel')
                        ->with('data', $eleves);

                // dd($eleves);   
            }else{
                return back()->withErrors([
                    'file' => 'Erreur dans le fichier, assurez vous que le fichier Excel Téléverser respecte  le format suivant :'
                ]);
            }

        }else{
            dd(101);
        }
    }
    
    public function storeImportedEleves(Request $request)
    {
        $request->validate(
            ['checked' => ['string', 'max:255', 'required']]
        );
        Eleve::getLastMatricule();

        $eleves = $request->session()->get('importedEleves');
        $request->session()->remove('importedEleves');

        foreach($eleves as $eleve){
            $matricule = Eleve::getLastMatricule();
            Eleve::create([
                'matricule' => $matricule,
                'nom' => $eleve['nom'],
                'prenom' => $eleve['prenom'],
                'lieu_naissance' => $eleve['lieu'],
                'date_naissance' => $eleve['date'],
                'nom_pere' => $eleve['pere'],
                'nom_mere' => $eleve['mere'],
                'adresse' => $eleve['adresse'],
                'sexe' => $eleve['sexe'],
            ]);
        }

        return redirect()->route('eleves.index')->with('imported', count($eleves));
        
    }
}