<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StartBonus;
class StartBonusController extends Controller
{
    public function index(){
        return StartBonus::all();
    }
}
