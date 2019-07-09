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
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="categories" style="font-size: 17px;">Webshop |</a>
  <a class="navbar-brand text-light justify-content-end" href="products" style="font-size: 17px;">&nbsp;All products</a>
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
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success" id="alert-create">
      {{ session()->get('success') }}  
    </div><br />
  @endif
        <a href="{{ route('products.create')}}" class="btn btn-success" style="margin-bottom: 40px; width: 100%">Create</a>
        @foreach($products as $product)
        <div class="card">
          <img src="{{asset('images/'.$product->product_photo)}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$product->product_name}}</h5>
              <p class="card-text">€{{$product->product_price}}</p>
              <a href="{{ route('products.addToCart', ['id' => $product->id]) }}" class="btn btn-success" role="button">Add to cart</a>
              <a href="/product/{{$product->id}}" class="btn btn-primary">Details</a>
              <!--<form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit" style="float: right;">Delete</button>
            </form>-->
            </div>
        </div>
        @endforeach
<div>
@endsection