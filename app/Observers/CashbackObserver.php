<?php

namespace App\Observers;

use App\Models\Orders;
use App\Models\Cashback;

class CashbackObserver
{
    /**
     * Handle the Orders "created" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function created(Orders $orders)
    {
        // dd('asdasdas');
    }

    /**
     * Handle the Orders "updated" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function updated(Orders $orders)
    {
        // $result = request()->all();
        // // dd($result['order_summa']);
        // $data = new Cashback();
        // if($result['order_summa']>50){
        //     $data->user_id=$result['user_id'];
        //     $data->cashback=($result['order_summa']*10)/100;
        //     $data->save();


        // }
        // return response()->json([
        //     'status' => 200,
        //     'message' => "Orders Products muvafaqiyatli qo'shildi",
        // ]);

    }

    /**
     * Handle the Orders "deleted" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function deleted(Orders $orders)
    {
        //
    }

    /**
     * Handle the Orders "restored" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function restored(Orders $orders)
    {
        //
    }

    /**
     * Handle the Orders "force deleted" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function forceDeleted(Orders $orders)
    {
        //
    }
}
