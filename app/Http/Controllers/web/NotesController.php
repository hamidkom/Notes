<?php

namespace App\Http\Controllers\web;


use App\Note;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\Note as NoteResource;


class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $currentuser = Auth::user();
      //dump($currentuser);
        $notes = Note::where('user_id' ,'=', $currentuser->id)->get();
        return view('notes.index')->with('notes',$notes);
    }

   
    public function create()
    {
        return view('notes.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'Title'=> 'required',
            'Content'=> 'required',
            'Observations'=> 'nullable'
        ]);
        $note=Note::create([
            'user_id'=>Auth::id(),
            'Title'=> $request->Title,
            'Content'=> $request->Content,
            'Observations'=> $request->Observations,
            'slug'=> str_slug($request->Title),
        ]);
        return redirect()->back();
    }

   
    public function show($slug)
    {
        
        $note = Note::where('slug' , $slug)->first();
        return view('notes.show')->with('note',$note);
    }

   
    public function edit($id)
    {
        $note = Note::find($id)->first();
        return view('notes.edit')->with('note',$note);
    }

   
    public function update(Request $request,  $id)
    {
        $note = Note::find( $id ) ;
        $this->validate($request,[
            'Title' =>  'required',
            'Content' =>  'required'
        ]);
        if ($request->has('Observations')) {
             
        $note->Observations = $request->Observations;

        }
        $note->Title = $request->Title;
        $note->Content = $request->Content;
        $note->save();
        return redirect()->back();

    }
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        return redirect()->back();

    }
}
