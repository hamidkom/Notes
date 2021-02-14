<?php

namespace App\Http\Controllers\api;

use App\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Note as NoteResource;

class NoteController extends BaseController
{
    public function index()
    {
    $notes = Note::all();
    return $this->sendResponse(NoteResource::collection($notes), 'notes retrieved Successfully!' );
    }


    public function userNotes($id)
    {
    $notes = Note::where('user_id' , $id)->get();
    return $this->sendResponse(NoteResource::collection($notes), 'notes retrieved Successfully!' );
    }


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

        $user = Auth::user();
        $input['user_id'] = $user->id;
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


        if ( $note->user_id != Auth::id()) {
            return $this->sendError('you dont have Permission' , $validator->errors());
        }
        $note->Title = $input['Title'];
        $note->Content = $input['Content'];
        $note->Observations = $input['Observations'];
        $note->save();

        return $this->sendResponse(new NoteResource($note), 'Note updated Successfully!' );

    }

    public function destroy(Note $note)
    {
        $errorMessage = [] ;

        if ( $note->user_id != Auth::id()) {
            return $this->sendError('You dont have Permission' , $errorMessage);
        }
        $note->delete();
        return $this->sendResponse(new NoteResource($note), 'Note deleted Successfully!' );

    }
}
