<?php

namespace App\Http\Controllers\Tipe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TbTipe;
use Illuminate\Support\Facades\Validator;

class AdminTipeController extends Controller
{
    public function index(){
        return view('admin.tipe.index');
    }

    public function apiData(){
        $data = TbTipe::select('*')->orderBy('id','DESC')->get();

        return DataTables::of($data)
        ->addColumn('action', function ($data) {
            $buttonEdit = "<button onclick='editData(".$data->id.")' style='border-radius:8px;margin-right:3px;' class='btn btn-warning btn-xs' data-toggle='tooltip' data-placement='top' title='Edit Data ".$data->id."'><i class='voyager-edit'></i></button>";
            $buttonDelete = "<button onclick='deleteData(".$data->id.")' style='border-radius:8px;margin-right:3px;' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Delete Data ".$data->id."'><i class='voyager-trash'></i></button>";
            return $buttonEdit.$buttonDelete;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tipe' => ['required', 'string'],
        ], [
            'nama_tipe.required' => 'Inputan Nama Tipe Wajib Diisi!',
            'nama_tipe.string' => 'Inputan Nama Tipe Harus Karakter/Huruf!',
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

            $tambahTipe = new TbTipe();
            $tambahTipe->nama_tipe = $request->nama_tipe;
            $tambahTipe->save();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data '.$request->nama_tipe.' Berhasil ditambahkan!';

        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 10000;
            $data['message'] = 'Data '.$request->nama_tipe.' gagal ditambahkan, karena'. $th;
        }

        return response()->json($data);
    }

    public function edit(Request $req)
    {
        $data = TbTipe::find($req->id);

        return response()->json($data);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_tipe' => ['required', 'string'],
        ], [
            'nama_tipe.required' => 'Inputan Nama Apartment Wajib Diisi!',
            'nama_tipe.string' => 'Inputan Nama Apartment Harus Karakter/Huruf!',
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

            $dataTipe = TbTipe::find($request->id);
            $dataTipe->nama_tipe = $request->nama_tipe;
            $dataTipe->save();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data '.$dataTipe->nama_tipe.' Berhasil diperbarui!';

        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 5000;
            $data['message'] = 'Data '.$dataTipe->nama_tipe.' gagal diperbarui, karena'. $th;
        }

        return response()->json($data);        
    }

    public function delete(Request $req)
    {
        try {
            $menu = TbTipe::find($req->id);
            $menu->delete();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data Tipe Berhasil dihapus!';
        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 5000;
            $data['message'] = 'Data Tipe gagal dihapus, karena'. $th;
        }

        return response()->json($data);
    }
}
