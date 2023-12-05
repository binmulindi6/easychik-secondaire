<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use Illuminate\Http\Request;

class LogfileController extends Controller
{
    public function index()
    {   
        $logs = Logfile::where('done_by','!=',1 )
        ->limit(100)        
        ->get();

        // dd(Logfile::classe()->table);

        return view('logs.index')
                ->with('logs', $logs)
                ->with('page_name', 'Historiques');

    }
    public function show($id)
    {   
        $log = Logfile::findOrFail($id);

        // dd(Logfile::classe()->table);

        return view('logs.show')
                ->with('log', $log)
                ->with('page_name', 'Historiques / Details');

    }
    public function restore($id)
    {   
        $log = Logfile::findOrFail($id);
        $log->restore();
        
        // dd(Logfile::classe()->table);

        return view('logs.show')
                ->with('log', $log)
                ->with('page_name', 'Historiques / Details');

    }
}
