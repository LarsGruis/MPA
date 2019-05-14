<?php

namespace App\Http\Controllers;

use App\Share;
use App\Categories;
use Illuminate\Http\Request;
use DB;

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
            'product_photo' => 'required'
        ]);

        $image = $request->file('product_photo');
        $new_name = rand() . '.png';

        $image->move(public_path("images"), $new_name);

        $share = new Share([
            'share_name' => $request->get('share_name'),
            'share_price'=> $request->get('share_price'),
            'share_qty'=> $request->get('share_qty'),
            'category_id'=> $request->get('category_id'),
            'product_photo'=> $new_name
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
