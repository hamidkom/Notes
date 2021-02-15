@extends('layouts.app')


@section('content')


<div class="container">

    <div class="row">
      <div class="col">
        
        <div class="jumbotron">
            <h1 class="display-4">Create Note</h1>
          </div>


      </div>
    
    </div>
    <div class="row">
      <div class="col">
        <form>
            <div class="form-group">
              <label for="exampleFormControlInput1">Title</label>
              <input type="text" class="form-control">
            </div>
           
            
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Content</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">Save</button>
                </div>

          </form>


    </div>
    
    </div>
  </div>


  @endsection