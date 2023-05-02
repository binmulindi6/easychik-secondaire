<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    protected $page_name = 'Messages';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $messages = Message::latest()->get();
        
        if(Auth::user()->isDirecteur()){
            $users = User::where('parrain_id', '!=', null)->get();
            $items = Message::where('destinateur', Auth::user()->id)->latest()->get();
            $sent = Message::where('expediteur', Auth::user()->id)->latest()->get();
        }
        
        if(Auth::user()->isParent()){
            $users = User::where('parrain_id', null)->get();
            $items = Message::where('destinateur', Auth::user()->id)->latest()->get();
            $sent = Message::where('expediteur', Auth::user()->id)->latest()->get();
        }

        // dd($items);

        return view('users.messages')
                ->with('users', $users)
                ->with('items', $items)
                ->with('sents', $sent)
                ->with('page_name', $this->page_name);
        // dd(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'destinateur' => ['required', 'string', 'max:255'],
            'objet' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
        ]);
        // dd(User::Directeurs());
        //to direction
        if($request->destinateur === 'Direction'){
            $users = User::Directeurs();

            foreach($users as $user){
                Message::create([
                    'objet' => $request->objet,
                    'contenu' => $request->contenu,
                    'expediteur' => Auth::user()->id,
                    'destinateur' => $user->id,
                ]);
            }
        }

        //to parents
        if($request->destinateur === 'Parents'){
            $users = User::Parents();

            foreach($users as $user){
                Message::create([
                    'objet' => $request->objet,
                    'contenu' => $request->contenu,
                    'expediteur' => Auth::user()->id,
                    'destinateur' => $user->id,
                ]);
            }
        }

        return redirect()->route('messages.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $message->read();
        if(Auth::user()->isDirecteur()){
            $users = User::where('parrain_id', '!=', null)->get();
            $items = Message::where('destinateur', Auth::user()->id)->latest()->get();
            $sent = Message::where('expediteur', Auth::user()->id)->latest()->get();
        }
        
        if(Auth::user()->isParent()){
            $users = User::where('parrain_id', null)->get();
            $items = Message::where('destinateur', Auth::user()->id)->latest()->get();
            $sent = Message::where('expediteur', Auth::user()->id)->latest()->get();
        }

        // dd($items);

        return view('users.messages')
                ->with('users', $users)
                ->with('items', $items)
                ->with('sents', $sent)
                ->with('message', $message)
                ->with('page_name', $this->page_name . " / Show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
