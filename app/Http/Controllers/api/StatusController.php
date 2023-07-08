<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Models\Status;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table('statuses')->get();
        return $data;
    }
    public function index_id(Request $request,$id)
    {
        $data=DB::table('statuses')           
        ->where('status_id','=',$id)
        ->get();
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
        $data = new Status();   
        $unique = (string) Str::uuid();
        $data->status_id = $unique;
        $data->status_name = $request->input('status_name');       
        $data->save();
        return response()->json([
            'status' => 200,
            'message' => "Status muvafaqiyatli qo'shildi",
        ]);
    }

    public function delete(Request $request)
    {
    //   dd($request['id']);
        $data = Status::where('status_id',$request['id'])->delete();
        return response()->json([
            'status' => 200,
            'message' => "Status muvafaqiyatli o'chirildi",
        ]);
    }
    public function update(Request $request)
    {
        $data = new Status();   
        // dd($request);    
        $data = DB::table('statuses')
            ->where('status_id', $request['status_id'])
            ->update(['status_name' => $request['status_name']]);
        return response()->json([
            'status' => 200,
            'message' => "Status muvafaqiyatli Yangilandi",
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
