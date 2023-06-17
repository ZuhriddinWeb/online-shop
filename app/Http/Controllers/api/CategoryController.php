<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table('categories')->get();
        return $data;
    }
    public function index_id($id)
    {
        $data=DB::table('categories')->where('category_id','=',$id)->get();
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
        $data = new Category();   
        $images = $request->images;
        $array_image;           


        for($i=0;$i<count($images);$i++){
            $imageName = time().$i.'.'.$images[$i]->extension(); 
            $images[$i]->move(public_path('images'), $imageName);
            $array_image=$imageName;
        }

        $data->category_name = $request->input('category_name');  
        $data->category_image = $array_image;      
        $data->save();
        return response()->json([
            'status' => 200,
            'message' => "Kategoriya muvafaqiyatli qo'shildi",
        ]);
    }
    public function delete(Request $request)
    {
    // {   dd($request['id']);
        $data = DB::table('categories')->where('id',$request['id'])->delete();
        return response()->json([
            'status' => 200,
            'message' => "Kategoriya muvafaqiyatli o'chirildi",
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = new Category();       
        $data = DB::table('categories')
            ->where('id', $id)
            ->update(['category_name' => $request['category_name']]);
        return response()->json([
            'status' => 200,
            'message' => "Protocol muvafaqiyatli Yangilandi",
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
