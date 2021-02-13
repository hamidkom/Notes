<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Note as NoteResource;

class NoteController extends Controller
{
    public function index()
    {
    $notes = Note::all();
    return $this->sendResponse(NoteResource::collection($notes), 'Posts retrieved Successfully!' );
    }


    // public function userPosts($id)
    // {
    // $posts = Note::where('user_id' , $id)->get();
    // return $this->sendResponse(NoteResource::collection($posts), 'Posts retrieved Successfully!' );
    // }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'Title'=>'required',
            'Content'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        // $user = Auth::user();
        // $input['user_id'] = $user->id;
        $note = Note::create($input);
        return $this->sendResponse($note, 'Note added Successfully!' );

    }


    public function show($id)
    {
        $note = Note::find($id);
        if (is_null($note)) {
            return $this->sendError('Note not found!' );
        }
        return $this->sendResponse(new NoteResource($note), 'Note retrieved Successfully!' );

    }

    public function update(Request $request, Note $note)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'Title'=>'required',
            'Content'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }


        // if ( $note->user_id != Auth::id()) {
        //     return $this->sendError('you dont have rights' , $validator->errors());
        // }
        $note->Title = $input['Title'];
        $note->Content = $input['Content'];
        $note->Observation = $input['Observation'];
        $note->save();

        return $this->sendResponse(new NoteResource($note), 'Note updated Successfully!' );

    }

    public function destroy(Note $note)
    {
        $errorMessage = [] ;

        // if ( $note->user_id != Auth::id()) {
        //     return $this->sendError('you dont have rights' , $errorMessage);
        // }
        $note->delete();
        return $this->sendResponse(new NoteResource($note), 'Note deleted Successfully!' );

    }
}
