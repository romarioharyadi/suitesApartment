<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TbBanner;
use Illuminate\Support\Facades\Validator;

class AdminBannerController extends Controller
{
    public function index(){
        return view('admin.banner.index');
    }

    public function apiData(){
        $data = TbBanner::orderBy('id', 'desc')->get();

        return DataTables::of($data)
        ->addColumn('image', function ($data) {
            $data = url('assets/images/'.$data->gambar_banner);
            $image = "<a target='_blank' href='{$data}'><img style='width:120px;' src='{$data}'></a>";
            return $image;
        })
        ->addColumn('action', function ($data) {
            $buttonEdit = "<button onclick='editData(".$data->id.")' style='border-radius:8px;margin-right:3px;' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Data ".$data->id."'><i class='voyager-edit'></i></button>";
            $buttonDelete = "<button onclick='deleteData(".$data->id.")' style='border-radius:8px;margin-right:3px;' class='btn btn-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Delete Data ".$data->id."'><i class='voyager-trash'></i></button>";
            return $buttonEdit.$buttonDelete;
        })
        ->rawColumns(['image','action'])
        ->make(true);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_banner' => ['required', 'string'],
            'gambar_banner' => ['required'],
        ], [
            'nama_banner.required' => 'Inputan Nama Banner Wajib Diisi!',
            'nama_banner.string' => 'Inputan Nama Banner Harus Karakter/Huruf!',
            'gambar_banner.required' => 'Inputan Gambar Banner Wajib Diisi!'
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

            $tambahBanner = new TbBanner();
            $tambahBanner->nama_banner = $request->nama_banner;
            if($request->hasFile('gambar_banner'))
            {
                $request->file('gambar_banner')->move('assets/images/',$request->file('gambar_banner')->getClientOriginalName());
                $tambahBanner->gambar_banner = $request->file('gambar_banner')->getClientOriginalName();
            }
            
            $tambahBanner->save();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data Banner '.$request->nama_banner.' Berhasil ditambahkan!';

        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 10000;
            $data['message'] = 'Data Banner '.$request->nama_banner.' gagal ditambahkan, karena'. $th;
        }

        return response()->json($data);
    }

    public function delete(Request $req)
    {
        try {
            $dataBanner = TbBanner::find($req->id);
            $dataBanner->delete();

            $data['title'] = "Berhasil";
            $data['status'] = "success";
            $data['timer'] = 2500;
            $data['message'] = 'Data Banner Berhasil dihapus!';
        } catch (\Throwable $th) {
            $data['title'] = "Error";
            $data['status'] = "error";
            $data['timer'] = 5000;
            $data['message'] = 'Data Banner gagal dihapus, karena'. $th;
        }

        return response()->json($data);
    }
}
