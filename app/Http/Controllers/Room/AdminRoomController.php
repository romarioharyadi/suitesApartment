<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TbRoom;
use App\Models\TbTipe;
use Illuminate\Support\Facades\Validator;

class AdminRoomController extends Controller
{
    public function index(){
        return view('admin.room.index');
    }

    public function apiData(){
        $data = TbRoom::select('*')->get();

        return DataTables::of($data)
        ->addColumn('tipe',function ($data) {
            $dataTipe = TbTipe::find($data->tipe_id);
            return $dataTipe->nama_tipe;
        })
        ->addColumn('ukuran',function ($data) {
            return ($data->ukuran.' meter');
        })
        ->addColumn('harga',function ($data) {
            return 'Rp. '. number_format($data->harga,0,',','.');
        })
        ->addColumn('image', function ($data) {
            $data = url('storage/img_apart/'.$data->image);
            $image = "<a target='_blank' href='{$data}'><img style='width:120px;' src='{$data}'></a>";
            return $image;
        })
        ->addColumn('action', function ($data) {
            $buttonEdit = "<button onclick='editData(".$data->id.")' style='border-radius:8px;margin-right:3px;' class='btn btn-warning btn-xs' data-toggle='tooltip' data-placement='top' title='Edit Data ".$data->id."'><i class='voyager-edit'></i></button>";
            $buttonDelete = "<button onclick='deleteData(".$data->id.")' style='border-radius:8px;margin-right:3px;' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Delete Data ".$data->id."'><i class='voyager-trash'></i></button>";
            return $buttonEdit.$buttonDelete;
        })
        ->rawColumns(['tipe','ukuran','harga','image','action'])
        ->make(true);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_apartment' => ['required', 'string'],
        ], [
            'nama_apartment.required' => 'Inputan Nama Apartment Wajib Diisi!',
            'nama_apartment.string' => 'Inputan Nama Apartment Harus Karakter/Huruf!',
        ]);

        try {

            if ($validator->fails()) {
                $pesan = '';
                foreach ($validator->messages()->get('*') as $error) {
                    foreach ($error as $q => $a) {
                        $pesan .= '<b>- '.$a. '</b><br>';
                    }
                }
                $solusi = substr($pesan, 0, -1);

                $data['title'] = "Gagal";
                $data['status'] = "error";
                $data['timer'] = 5000;
                $data['message'] = 'Gagal menambahkan data karena : <br>'.$solusi.'';

                return response()->json($data);exit;
            }

            $tambahRoom = new TbRoom();
            $tambahRoom->nama_apartment = $request->nama_apartment;
            $tambahRoom->tipe_id = $request->tipe;
            $tambahRoom->harga = $request->harga;
            $tambahRoom->alamat = $request->alamat;
            $tambahRoom->ukuran = $request->ukuran;
            $tambahRoom->kamar_tidur = $request->kamar_tidur;
            $tambahRoom->kamar_mandi = $request->kamar_mandi;
            $tambahRoom->waktu_posting = date('Y-m-d');
            if($request->hasFile('image'))
            {
                $request->file('image')->move('assets/img_apart/',$request->file('image')->getClientOriginalName());
                $tambahRoom->image = $request->file('image')->getClientOriginalName();
            }
            $tambahRoom->save();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data '.$request->nama_apartment.' Berhasil ditambahkan!';

        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 10000;
            $data['message'] = 'Data '.$request->nama_apartment.' gagal ditambahkan, karena'. $th;
        }

        return response()->json($data);
    }

    public function edit(Request $req)
    {
        $dataRoom = TbRoom::find($req->id);
        $dataTipe = TbTipe::find($dataRoom->tipe_id);
        $data = [
            'dataRoom' => $dataRoom,
            'dataTipe' => $dataTipe,
        ];

        return response()->json($data);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_apartment' => ['required', 'string'],
        ], [
            'nama_apartment.required' => 'Inputan Nama Apartment Wajib Diisi!',
            'nama_apartment.string' => 'Inputan Nama Apartment Harus Karakter/Huruf!',
        ]);

        try {

            if ($validator->fails()) {
                $pesan = '';
                foreach ($validator->messages()->get('*') as $error) {
                    foreach ($error as $q => $a) {
                        $pesan .= '<b>- '.$a. '</b><br>';
                    }
                }
                $solusi = substr($pesan, 0, -1);

                $data['title'] = "Gagal";
                $data['status'] = "error";
                $data['timer'] = 5000;
                $data['message'] = 'Gagal menambahkan data karena : <br>'.$solusi.'';

                return response()->json($data);exit;
            }

            $dataRoom = TbRoom::find($request->idRoom);
            $dataRoom->nama_apartment = $request->nama_apartment;
            $dataRoom->tipe_id = $request->tipe;
            $dataRoom->harga = $request->harga;
            $dataRoom->alamat = $request->alamat;
            $dataRoom->ukuran = $request->ukuran;
            $dataRoom->kamar_tidur = $request->kamar_tidur;
            $dataRoom->kamar_mandi = $request->kamar_mandi;
            $dataRoom->waktu_posting = date('Y-m-d');
            if($request->hasFile('image'))
            {
                $request->file('image')->move('assets/img_apart/',$request->file('image')->getClientOriginalName());
                $dataRoom->image = $request->file('image')->getClientOriginalName();
            }
            $dataRoom->save();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data '.$dataRoom->nama_apartment.' Berhasil diperbarui!';

        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 5000;
            $data['message'] = 'Data '.$dataRoom->nama_apartment.' gagal diperbarui, karena'. $th;
        }

        return response()->json($data);        
    }

    public function delete(Request $req)
    {
        try {
            $menu = TbRoom::find($req->id);
            $menu->delete();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data Room Berhasil dihapus!';
        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 5000;
            $data['message'] = 'Data Room gagal dihapus, karena'. $th;
        }

        return response()->json($data);
    }

    public function getTipe(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $data = TbTipe::all();
        }else{
            $data = TbTipe::where('nama_tipe', 'like', '%'.$search.'%')->get();
        }

        $response = array();
        foreach($data as $Tipe) {
            $response[] = array(
                "id" => $Tipe->id,
                "text" => $Tipe->nama_tipe
            );
        }

        echo json_encode($response);
        exit;
    }
}
