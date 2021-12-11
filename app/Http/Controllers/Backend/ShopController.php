<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCartRequest;
use App\Http\Requests\PostShopRequest;
use App\Models\Invoice;
use App\Models\Invoice_details;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('shops.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCartRequest $request)
    {

        $invoice = new Invoice([
            'user_id' => Auth::user()->id,
            'total' => str_replace( ',', '', Cart::subtotal() ),
        ]);
        $invoice->save();

        foreach(Cart::content() as $row =>$product) {

            $invoice_details = new Invoice_details([
                'product_id' => $product->id,
                'invoice_id' =>  $invoice->id,
                'quantity' => $product->qty,
                'subtotal' => str_replace( ',', '', $product->qty*$product->price ),
            ]);
            $invoice_details->save();
            DB::table('stocks')->where('product_id',$product->id)->decrement('quantity',$product->qty);
        }
        Cart::destroy();
          return back()->with('status', "products purchased successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        Cart::destroy();
        return back()->with('status', "The Cart was emptied successfully");

    }
}
