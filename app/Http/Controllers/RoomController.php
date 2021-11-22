<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbTipe;

class RoomController extends Controller
{
    public function index(){
        $dataRoom = TbRoom::all();

        return view('master',compact('dataRoom'));
    }
}
