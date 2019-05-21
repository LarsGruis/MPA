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
    width: 100%;
    float: left;
    margin-bottom: 20px;
  }

  .btn-success {
    display: block;
    margin: 0 auto;
    float: none;
    width: 100%;
  }

  .btn-danger {
    display: block;
    margin: 0 auto;
    margin-top: 10px;
    float: none;
    width: 100%;
  }

  @media(max-width: 1115px) {
    .btn-success {
      width: 100%;
    }
  }

  .btn-group {
    float: right;
  }

  .dropdown-toggle {
    margin-bottom: 0;
  }

  .list-group-item {
      line-height: 35px;
  }

  /*ul {
    padding-left: 540px;
    padding-right: 540px;
  }*/
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="categories" style="font-size: 17px;">Webshop |</a>
  <a class="navbar-brand text-light justify-content-end" href="shares" style="font-size: 17px;">&nbsp;All products</a>
  <a href="{{ route('shares.shoppingCart') }}">
      <span class="badge text-light" style="float: right;">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
    <i class="fas fa-shopping-cart text-light" style="float: right; line-height: 35px; font-size: 30px;"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
</nav>

@if(Session::has('cart'))
  <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3" style="margin: 0 auto; margin-top: 25px;">
        <ul class="list-group">
          @foreach($shares as $share)
              <li class="list-group-item">
                <span class="badge">{{ $share['qty'] }}</span>
                <strong>{{ $share['item']['share_name'] }}</strong>
                <span class="label label-success">€{{ $share['item']['share_price'] }}</span>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Reduce by 1</a></li>
                    <li><a href="#">Reduce all</a></li>
                  </ul>
                </div>
              </li>
          @endforeach
        </ul>
    </div>
  </div>
  <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3" style="margin: 0 auto; padding-top: 18px;">
          <strong>Total: {{ $totalPrice  }}</strong>
      </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3" style="margin: 0 auto;">
          <button type="button" class="btn btn-success">Checkout</button>
      </div>
  </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3" style="margin: 0 auto;">
          <button type="button" class="btn btn-danger" href="{{ route('shares.deleteCart') }}">Verwijder alles</button>
      </div>
  </div>
@else
  <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
         <h2>No items in Cart!</h2>
      </div>
  </div>
@endif
@endsection