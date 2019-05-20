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

  .navbar {
    display: block !important;
  }


  .card-title {
    text-align: center;
    padding-top: 25px;
    padding-bottom: 25px;
  }
  
  .container {
    max-width: 100%;
    width: 100%;
    padding-left: 0;
    padding-right: 0;
  }

  .navbar-brand {
    font-size: 30px;
    margin-right: 0;
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
    width: 100%;
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
  <a class="navbar-brand text-light" href="categories" style="font-size: 17px;">Webshop |</a>
  <a class="navbar-brand text-light justify-content-end" href="shares" style="font-size: 17px;">&nbsp;All products</a>
  <i class="fas fa-shopping-cart text-light" style="float: right; line-height: 35px;"></i>
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
  <a href="{{ route('categories.create')}}" class="btn btn-success" style="margin-bottom: 40px; width: 100%">Create category</a>
        @foreach($categories as $category)
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$category->name}}</h5>
              <a href="{{ url('shares?category=' . $category->id)}}" class="btn btn-primary">Producten</a>
            </div>
        </div>
        @endforeach
<div>
@endsection