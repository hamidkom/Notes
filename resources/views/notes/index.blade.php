@extends('layouts.app')


@section('content')


<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">All Notes</h1>
            <a class="btn btn-success" href="{{ route('note.create') }}" class="hre">Create Note</a>
        </div>
          </div>
      
    </div>
    <div class="row">
        @if ($notes->count()>0)
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Observations</th>
                    <th scope="col">User</th>
                    <th scope="col">Actions</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($notes as $item)
                  <tr>
                    <th scope="row">3</th>
                    <td>{{ $item->Title }}</td>
                    <td>{{ $item->Observations }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                     <a href="{{ route('note.show',['slug'=>$item->slug]) }}"  <i class="text-success fas fa-2x fa-eye"></i></a>   
                     <a href="{{ route('note.edit',['id'=>$item->id]) }}"  <i class="fas fa-edit fa-2x"></i></a>   
                     <a href="{{ route('note.destroy',['id'=>$item->id]) }}"  <i class="text-danger fas fa-trash-alt fa-2x"></i></a>   
                    <td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            
        </div>

        @else
        <div class="col">
            <div class="alert alert-success" role="alert">
                No notes Found
                </div>
        </div>
           
        @endif
      
    
    </div>
  </div>
  @endsection