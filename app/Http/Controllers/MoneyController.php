<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Money;
class MoneyController extends Controller
{

    public function show($period){
        return Money::where('period', $period)->first();
    }


    public function store(Request $request){
        return Money::create([
            'user_id' => $request->user_id,
            'period' => $request->period,
            'summa' => $request->summa,
            'check' => false,
        ]);
    }
}
