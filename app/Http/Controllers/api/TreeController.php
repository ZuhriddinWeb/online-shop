<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Models\Tree;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table('trees')->get();
        return $data;
    }
    public function index_id($id)
    {
        $data=DB::table('trees')->where('id','=',$id)->get();
        return $data;
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
    public function store(Request $request)
    {
        $data = new Tree();   
        // dd($data);
        $data->name = $request->input('name');       
        $data->save();
        return response()->json([
            'status' => 200,
            'message' => "Tip muvafaqiyatli qo'shildi",
        ]);
    }
    public function delete(Request $request)
    {
    // {   dd($request['id']);
        $data = DB::table('trees')->where('id',$request['id'])->delete();
        return response()->json([
            'status' => 200,
            'message' => "Tip muvafaqiyatli o'chirildi",
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = new Tree();       
        $data = DB::table('trees')
            ->where('id', $id)
            ->update(['name' => $request['name']]);
        return response()->json([
            'status' => 200,
            'message' => "Tip muvafaqiyatli Yangilandi",
        ]);
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
