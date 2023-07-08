<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Products;

use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // return DB::table('carts')->where('user_id','=',$id)->get();
        return Cart::where('user_id' , $id)->get();
    }
    public function index_id($id)
    {
        // return DB::table('carts')->where('user_id','=',$id)->get();
        return Products::where('id' , $id)->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $cart = Cart::where([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ]);
        if($cart->count()){
            $cart->delete();
            return false;
        }
        else{
            $data = new Cart();
            $data->user_id = Auth::user()->id; 
            $data->product_id = $id;   

            $data->save();
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        return DB::table('carts') 
        ->select(DB::raw('count(*) as id_count'))
        ->where('user_id', Auth::user()->id)
        ->get();
    }
    public function clear(Request $request)
    {   
        DB::table('carts')->where('user_id', Auth::user()->id)->delete();
        return response()->json([
            'status' => 200,
            'message' => "Savatcha muvafaqiyatli Tozalandi",
        ]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::find($id)->delete();
    }
}
