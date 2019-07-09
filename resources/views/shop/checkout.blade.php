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
    width: 50%;
    display: block;
    margin: 0 auto;
  }

  .btn-success {
    display: block;
    margin: 0 auto;
    float: none;
    width: 34%;
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

  .fa-trash-alt {
    float: right;
    padding-right: 15px;
    line-height: 35px;
  }

  .form-group {
  	width: 100%;
  }

  /*ul {
    padding-left: 540px;
    padding-right: 540px;
  }*/
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="categories" style="font-size: 17px;">Webshop |</a>
  <a class="navbar-brand text-light justify-content-end" href="shares" style="font-size: 17px;">&nbsp;All products</a>
  <a href="{{ url('shopping-cart') }}">
      <span class="badge text-light" style="float: right; font-size: 26px;">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
    <i class="fas fa-shopping-cart text-light" style="float: right; line-height: 35px; font-size: 30px;"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
</nav>

      <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3" style="margin: 0 auto;">
            <h1>Checkout</h1>
            <h4>Je totaal: €{{ $total }}</h4>
            <div id="charge-error" style="display: none;" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''  }}">
                {{ Session::get('error') }}
            </div>
            <form action="{{ route('checkout') }}" method="post" id="checkout-form">
                <div class="row">
                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" id="name" class="form-control" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="address">Adres</label>
                            <input type="text" id="address" class="form-control" required name="address">
                        </div>
                    <hr>
                        <div class="form-group">
                            <label for="card-name">Naam kaarthouder</label>
                            <input type="text" id="card-name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="card-number">Credit card nummber</label>
                            <input type="text" id="card-number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="card-expiry-month">Vervalmaand</label>
                            <input type="text" id="card-expiry-month" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="card-expiry-year">Vervaljaar</label>
                            <input type="text" id="card-expiry-year" class="form-control" required>
                        </div>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success">Koop nu</button>
            </form>
        </div>
    </div>

@endsection