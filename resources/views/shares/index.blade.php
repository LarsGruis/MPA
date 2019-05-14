@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
    max-width: 1140px;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 40px;
  }
  
  .container {
    max-width: 100%;
    width: 100%;
    padding-left: 0;
    padding-right: 0;
  }

  .navbar-brand {
    margin: 0 auto;
    font-size: 30px;
  }

  .card {
    width: calc(25% - (4px * 3) / 4); 
    display: inline-block; 
    margin-bottom: 4px;
  }

  @media(max-width: 767px) {
    .card {
      width: 100%;
    }
  }

  .card-img-top {
    width: 50%; 
    display: block; 
    margin: 0 auto; 
    padding-top: 25px; 
    padding-bottom: 5px;
  }

  @media(max-width: 1115px) {
    .btn-primary {
      width: 100% !important;
    }
  }


  .btn-primary {
    width: 49%;
    float: left;
    margin-bottom: 20px;
  }

  .btn-danger {
      width: 49%;
      float: right;
      margin-bottom: 20px;
  }

  @media(max-width: 1115px) {
    .btn-danger {
      width: 100%;
    }
  }


  /*ul {
    padding-left: 540px;
    padding-right: 540px;
  }*/
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="categories">Webshop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success" id="alert-create">
      {{ session()->get('success') }}  
    </div><br />
  @endif
        <a href="{{ route('shares.create')}}" class="btn btn-success" style="margin-bottom: 40px; width: 100%">Create</a>
        @foreach($shares as $share)
        <div class="card">
          <img src="{{$share->product_photo}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$share->share_name}}</h5>
              <p class="card-text">€{{$share->share_price}}</p>
              <a href="{{ route('shares.edit',$share->id)}}" class="btn btn-primary">Edit</a>
              <form action="{{ route('shares.destroy', $share->id)}}" method="post" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit" style="float: right;">Delete</button>
            </form>
            </div>
        </div>
        @endforeach
<div>
@endsection