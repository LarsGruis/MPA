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
    display: block; 
    margin: 0 auto; 
    padding-top: 25px; 
    padding-bottom: 5px;
    height: 300px;
    width: auto;
    overflow: hidden;
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

  .btn-success {
      width: 49%;
      float: right;
      margin-bottom: 20px;
  }

  @media(max-width: 1115px) {
    .btn-success {
      width: 100%;
    }
  }

  .login {
    color: white;
    width: 10%;
    float: right;
    text-align: right;
  }

  .login a {
    color: white;
    line-height: 35px;
    font-size: 17px;
    text-decoration: none;
  }

  /*ul {
    padding-left: 540px;
    padding-right: 540px;
  }*/
</style>

@if(Session::has('cart'))
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="categories" style="font-size: 17px;">Webshop |</a>
  <a class="navbar-brand text-light justify-content-end" href="shares" style="font-size: 17px;">&nbsp;All products</a>
  <a href="{{ url('shopping-cart') }}">
    <span class="badge text-light" style="float: right; font-size: 19px;">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
    <i class="fas fa-shopping-cart text-light" style="float: right; line-height: 35px; font-size: 19px;"></i>
  </a>
  <div class="login">
    <a href="http://test.local/login">Login&nbsp;</a>
    <a href="http://test.local/register">Register&nbsp; |&nbsp;</a>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
</nav>

<h1 style="text-align: center; margin-top: 25px; margin-bottom: 25px;">Bedankt voor uw bestelling!</h1>
<a href="{{ route('products.deleteCartAfterOrder') }}" class="btn btn-success" style="display: block; margin: 0 auto; float: none; width: 50%;">Klik hier om terug te gaan naar het artikeloverzicht</a>

@endif
@endsection

