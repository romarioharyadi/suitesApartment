<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbBanner;
use App\Models\TbRoom;

class MasterController extends Controller
{
    public function index(){
        $data['dataBanner'] = TbBanner::all();
        $data['dataRoom'] = TbRoom::select('*')
            ->leftJoin('tb_tipe','tb_tipe.id','=','tb_room.tipe_id')
            ->get();

        return view('master',$data);
    }
}
