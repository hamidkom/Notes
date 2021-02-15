@extends('layouts.app')


@section('content')


<div class="container">

    


      <div class="col">
        

        <div class="card jumbotron" style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title"> <strong>Title : </strong> {{ $note->Title }}</h5>
              <p class="card-text">{{$note->Content}}</p>
              <p class="card-text"><strong>OBS : </strong> {{$note->Observations}}</p>
              <p class="card-text">Created : {{$note->created_at->diffForhumans()}}</p>
              <p class="card-text">Updated : {{$note->updated_at->diffForhumans()}}</p>
              <a class="btn btn-success" href="{{ route('notes') }}" class="hre">All notes</a>
            </div>
          </div>
          

    </div>
    
    </div>
  </div>


  @endsection