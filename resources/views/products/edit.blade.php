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
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="products">Webshop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<div class="card uper">
  <div class="card-header">
    Edit Product
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('products.update', $product->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Product Name:</label>
          <input type="text" class="form-control" name="product_name" value={{ $product->product_name }} />
        </div>
        <div class="form-group">
          <label for="price">Product Price :</label>
          <input type="text" class="form-control" name="product_price" value={{ $product->product_price }} />
        </div>
        <div class="form-group">
          <label for="quantity">Product Quantity:</label>
          <input type="text" class="form-control" name="product_qty" value={{ $product->product_qty }} />
        </div>
        <div class="form-group">
              <label for="quantity">Category id:</label>
              <input type="number" class="form-control" name="category_id" value=value={{ $product->category_id }} />
        </div>
        <div class="form-group">
              <label for="photo">Product photo:</label>
              <input type="file" class="form-control" name="product_photo"/>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection