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

  .card-img-top { 
    padding-bottom: 5px;
    padding-left: 25px;
    padding-right: 25px;
    padding-top: 25px;
    height: 300px;
    width: auto;
    overflow: hidden;
    float: left;
  }

  .product_detail {
    float: left;
    padding-top: 35px;
  }

  /*ul {
    padding-left: 540px;
    padding-right: 540px;
  }*/
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="categories" style="font-size: 17px;">Webshop |</a>
  <a class="navbar-brand text-light justify-content-end" href="products" style="font-size: 17px;">&nbsp;All products</a>
  <i class="fas fa-shopping-cart text-light" style="float: right; line-height: 35px; font-size: 30px;"></i>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
</nav>          
  <img src="{{asset('images/'.$product->product_photo)}}" class="card-img-top" alt="...">
  <p class="product_detail">{{$product->product_detail}}</p>
@endsection