<?php

namespace App\Http\Controllers;

use App\Product;
use App\Categories;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Cart;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->get('category');

        $products = product::all();
        if ($id !== null) {
            $products = DB::table('products')->where('category_id', $id)->get();
        }

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'=>'required',
            'product_price'=> 'required|integer',
            'product_qty' => 'required|integer',
            'category_id' => 'required|integer',
            'product_photo' => 'required', 
            'product_detail' => 'required'
        ]);

        $image = $request->file('product_photo');
        $new_name = rand() . '.png';

        $image->move(public_path("images"), $new_name);

        $product = new product([
            'product_name' => $request->get('product_name'),
            'product_price'=> $request->get('product_price'),
            'product_qty'=> $request->get('product_qty'),
            'category_id'=> $request->get('category_id'),
            'product_photo'=> $new_name, 
            'product_detail'=> $request->get('product_detail'),
        ]);
        $product->save();
        return redirect('/categories')->with('success', 'product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = product::find($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name'=>'required',
            'product_price'=> 'required|integer',
            'category_id'=> 'required|integer',
            'product_qty' => 'required|integer'
        ]);

        $product = product::find($id);
        $product->product_name = $request->get('product_name');
        $product->product_price = $request->get('product_price');
        $product->product_qty = $request->get('product_qty');
        $product->category_id = $request->get('category_id');
        $product->product_photo = $request->get('product_photo');
        $product->save();

        return redirect('/products')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $product = product::find($id);
     $product->delete();

     return redirect('/products')->with('success', 'Stock has been deleted Successfully');
    }

    public function getDetails(Request $request, product $product)
    {
        $id = $request->get('product_detail');

        // dd($product);
       

        return view('products.detail', ['product' => $product]);
    } 

    public function getAddToCart(Request $request, $id) 
    {
        // if (! $request->user) {
        //     return redirect()->route('login');
        // }

        // if ($request->user) {
        //      return redirect()->route('shop.shopping-cart');
        // }

        $product = product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('products.index');
    }

    public function getCart(Request $request)
    {
        // if (! $request->user) {
        //     return redirect()->route('login');
        // }

        if (!Session::has('cart'))
        {
            return view('shop.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function deleteCart()
    {
        // if (! $request->user) {
        //     return redirect()->route('login');
        // }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->delete();
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function deleteproduct($id)
    {

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->deleteOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            $cart->delete();
        }

        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function getRemoveproduct($id) 
    {        
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeproduct($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            $cart->delete();
        }

        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function deleteCartAfterOrder()
    {
        // if (! $request->user) {
        //     return redirect()->route('login');
        // }
        $products = product::all();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->deleteAfterOrder();

        session()->put('cart', null);
        return view('products.index', ['products' => $products]);
    }

    // function upload(Request $request)
    // {
    //     $this->validate($request, [
    //         'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ]);
    //     $image = $request->file('select_file');
    //     $new_name = $random() . '.' . $image-> getClientOriginalExtension();
    //     $image->move(public_path("images"), $new_name);
    //     return back()->with('success', 'Image Uploaded Successfully')->with('path', $new_name);
    // }
}
