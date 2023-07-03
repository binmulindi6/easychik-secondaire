<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Logfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'table_name',
        'item_id',
        'event',
        'done_by',
    ];

    //save Create Log
    public static function createLog($table_name, $item)
    {
        $log = Logfile::create([
            'table_name' => $table_name,
            'item_id' => $item,
            'event' => "Creation",
            'done_by' => Auth::user()->id
        ]);

        $log->save();
    }

    //save Update Log
    public static function updateLog($table_name, $item)
    {
        $log = Logfile::create([
            'table_name' => $table_name,
            'item_id' => $item,
            'event' => "Modification",
            'done_by' => Auth::user()->id
        ]);

        $log->save();
    }

    //save Delete Log
    public static function deleteLog($table_name, $item)
    {
        $log = Logfile::create([
            'table_name' => $table_name,
            'item_id' => $item,
            'event' => "Suppression",
            'done_by' => Auth::user()->id
        ]);

        $log->save();
    }
    public static function restoreLog($table_name, $item)
    {
        $log = Logfile::create([
            'table_name' => $table_name,
            'item_id' => $item,
            'event' => "Restoration",
            'done_by' => Auth::user()->id
        ]);

        $log->save();
    }


    /**
     * get the log Item
     */

    public function item()
    {
        // dd($this->item_id);
        $table = substr(ucfirst($this->table_name), 0, -1);

        if ($this->event === 'Suppression') {
            return  DB::table($this->table_name)
                ->where('id', $this->item_id)
                ->where('deleted_at', '!=', null)
                ->first();
        } else {
            return  DB::table($this->table_name)
                ->where('id', $this->item_id)
                ->first();
        }
    }

    public function restore()
    {
        // dd($this->item_id);
        Logfile::restoreLog($this->table_name,$this->item_id);
            return  DB::table($this->table_name)
                ->where('id', $this->item_id)
                ->update(['deleted_at' => null]);
    }

    public function element()
    {
        return DB::table($this->table_name)
            ->where('id', $this->item_id)
            ->withTrashed()
            ->first();
    }

    /**
     * get the Event log
     */

    public function user()
    {
        return User::findOrFail($this->done_by);
    }
}
