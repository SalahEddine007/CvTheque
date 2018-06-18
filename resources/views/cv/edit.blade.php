@extends('layouts.app')




@section('content')

<!-- @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

<div class="container">
    <div class="row">
        <div class="col-md-12">

    <form action="{{ url('cvs/'.$cv->id) }}" method="post" enctype="multipart/form-data">
    <div class="form-group @if($errors->get('titre')) has-error @endif">
    
    <input type="hidden" name="_method" value="PUT">

        {{ csrf_field() }}

        <div class="form-group">
        <label for="">Titre</label>
        <input type="text" name="titre" class="form-control" value="{{ $cv->titre }}">
        @if($errors->get('titre'))
            @foreach($errors->get('titre') as $message)
              <li class="list-unstyled">{{ $message }}</li>
            @endforeach  
        @endif
        </div>

        <div class="form-group">
        <label for="">Présentation</label>
        <textarea name="presentation" class="form-control">{{ $cv->presentation }}</textarea>
        @if($errors->get('presentation'))
            @foreach($errors->get('presentation') as $message)
              <li class="list-unstyled">{{ $message }}</li>
            @endforeach  
        @endif
        <!-- <input type="text" name="presentation" class="form-control"> -->
        </div>

        <div class="form-group">
        <label for="">Images</label>
        <input class="form-control" type="file" name="photo">
        </div>

        <div class="form-group">
        <label for=""></label>
        <input type="submit" class="form-control btn btn-danger" value="Modifier">
        </div>
    </form>

        </div>
    </div>
</div>



@endsection