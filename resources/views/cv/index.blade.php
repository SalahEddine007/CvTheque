@extends('layouts.app')




@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h1>La liste de mes cv</h1><hr><br>
           <div class="pull-right">
             <a href="{{ url('cvs/create') }}" class="btn btn-success">Nouveau cv</a>
           </div>
           <br><br>
<div class="row">
   @foreach($cvs as $cv)
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="{{ asset('storage/'.$cv->photo) }}" alt="...">
      <div class="caption">
      <form action="{{ url('cvs/'.$cv->id) }}" method="post">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
        <h3>{{ $cv->titre }}</h3>
        <p>{{ $cv->presentation }}</p>

        <a href="{{ url('cvs/'.$cv->id) }}" class="btn btn-primary" role="button">Show</a>
        <a href="{{ url('cvs/'.$cv->id.'/edit') }}" class="btn btn-warning" role="button">Editer</a>
        <a href="#" class="btn btn-danger" type="submit" >Delete</a>
        <!-- @can('delete', $cv)
        <button type="submit" class="btn btn-danger" role="button">Delete</button>
        @endcan -->
         </p>
         </form>
      </div>
    </div>
  </div>
  @endforeach
</div>

        </div>
    </div>
</div> 



@endsection


           