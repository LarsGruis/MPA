<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Categories;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Cart;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOrders(Request $request)
    {
        return view('order.index', ['orders' => $orders]);
    }

    public function getCheckout()
    {
        if (!Session::has('cart'))
        {
            return view('shop.shopping-cart');
        } 

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout()
    {
        if (!Session::has('cart'))
        {
            return view('shop.shopping-cart');
        } 

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('order.index');
    }

    public function store(Request $request)
    {
       $order = new order([
            'order_id' => $request->get('order_id'),
            'product_id'=> $request->get('product_id'),
            'amount'=> $request->get('amount'),
            'price_per_piece'=> $request->get('price_per_piece'),
            'subtotal'=> $request->get('subtotal'),
        ]);
        $order->save();
        return redirect('/products');
    }
}

































