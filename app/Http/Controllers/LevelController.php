<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;


class LevelController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif

        $level = LevelModel::all(); //ambil data level untuk filter level

        return view('level.index', ['breadcrumb' => $breadcrumb,'level' => $level, 'page' => $page, 'activeMenu' => $activeMenu]);
    }  

    public function list(Request $request)
    {
        $level = LevelModel::select('level_id','level_kode','level_nama');
            // ->with('level');

        //Filter data user berdasarkan level_id
        if ($request->level_id){
            $level->where('level_id', $request->level_id);
        }
     
        return DataTables::of($level)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/level/'.$level->level_id).'">'
                    . csrf_field() 
                    . method_field('DELETE') 
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                    
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah HTML
            ->make(true);
    }
  
    public function create(){
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $level = LevelModel::all(); //ambil data level untuk ditampilkan di form
        $activeMenu = 'level'; //set menu yang sedang aktif

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);

    }

    public function store(Request $request){
        $request->validate([
            //username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'level_kode'  => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama'  => 'required|string|max:100'        //nama harus diisi, berupa string dan maksimal 100 karakter
        ]);   

        LevelModel::create([
            'level_kode'  => $request->level_kode,
            'level_nama'      => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function show(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif

        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $level = LevelModel::find($id);
        // $level = LevelModel::all();
    

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }
    
    public function update(Request $request, string $id){
        $request->validate([
            'level_kode'  => 'required|string|max:10|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama'  => 'required|string|max:100',        //nama harus diisi, berupa string dan maksimal 100 karakter
      
        ]);

        LevelModel::find($id)->update([
            'level_kode'  => $request->level_kode,
            'level_nama'  => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id) {
        $check = LevelModel::find($id);
        if(!$check){
            return redirect('/level')->with('error', 'Data Level tidak ditemukan');
        }

        try{
            LevelModel::destroy($id); //Hapus data level

            return redirect('/level')->with('success', 'Data berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan eror
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    // public function index(){
        //INSERT DATA 
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)', ['CUS','Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        //UPDATE DATA
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris';4

        //DELETE DATA
        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus : '.$row.' baris';

    //     $data = DB::select('select * from m_level');
    //     return view('level', ['data' => $data]);
    // }
}
