@extends('layouts.app')


@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
        <h2>Cette Page est non autoriser</h2>
        <a href="{{ url('cvs') }}" class="btn btn-default" role="button"> << Retour</a>
        </div>
    </div>
</div>



@endsection