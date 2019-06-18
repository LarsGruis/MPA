<?php

namespace App\Http\Controllers;

use App\Share;
use App\Categories;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Cart;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->get('category');

        $shares = Share::all();
        if ($id !== null) {
            $shares = DB::table('shares')->where('category_id', $id)->get();
        }

        return view('shares.index', ['shares' => $shares]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shares.create');
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
            'share_name'=>'required',
            'share_price'=> 'required|integer',
            'share_qty' => 'required|integer',
            'category_id' => 'required|integer',
            'product_photo' => 'required', 
            'product_detail' => 'required'
        ]);

        $image = $request->file('product_photo');
        $new_name = rand() . '.png';

        $image->move(public_path("images"), $new_name);

        $share = new Share([
            'share_name' => $request->get('share_name'),
            'share_price'=> $request->get('share_price'),
            'share_qty'=> $request->get('share_qty'),
            'category_id'=> $request->get('category_id'),
            'product_photo'=> $new_name, 
            'product_detail'=> $request->get('product_detail'),
        ]);
        $share->save();
        return redirect('/categories')->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $share = Share::find($id);

        return view('shares.edit', compact('share'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'share_name'=>'required',
            'share_price'=> 'required|integer',
            'category_id'=> 'required|integer',
            'share_qty' => 'required|integer'
        ]);

        $share = Share::find($id);
        $share->share_name = $request->get('share_name');
        $share->share_price = $request->get('share_price');
        $share->share_qty = $request->get('share_qty');
        $share->category_id = $request->get('category_id');
        $share->product_photo = $request->get('product_photo');
        $share->save();

        return redirect('/shares')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $share = Share::find($id);
     $share->delete();

     return redirect('/shares')->with('success', 'Stock has been deleted Successfully');
    }

    public function getDetails(Request $request, Share $share)
    {
        $id = $request->get('product_detail');

        // dd($share);
       

        return view('shares.detail', ['share' => $share]);
    } 

    public function getAddToCart(Request $request, $id) 
    {
        if (! $request->user) {
            return redirect()->route('login');
        }

        // if ($request->user) {
        //     return redirect()->route('shop.shopping-cart');
        // }

        $share = Share::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($share, $share->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('shares.index');
    }

    public function getCart(Request $request)
    {
        if (!Session::has('cart'))
        {
            return view('shop.shopping-cart', ['shares' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['shares' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function deleteCart()
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->delete();
        return view('shop.shopping-cart', ['shares' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function deleteProduct(Request $request)
    {
        $share = $request->get('share');

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->deleteOne($share);

        return view('shop.shopping-cart', ['shares' => $cart->items, 'totalPrice' => $cart->totalPrice]);
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
