<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;


class BarangController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; //set menu yang sedang aktif

        $kategori = KategoriModel::all(); //ambil data level untuk filter level

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $barang = BarangModel::select('barang_id', 'kategori_id','barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
            ->with('kategori');

        //Filter data barang berdasarkan level_id
        if ($request->kategori_id){
            $barang->where('kategori_id', $request->kategori_id);
        }
        
        return DataTables::of($barang)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/barang/'.$barang->barang_id).'">'
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
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang baru'
        ];

        $kategori = KategoriModel::all(); //ambil data kategori untuk ditampilkan di form
        $activeMenu = 'barang'; //set menu yang sedang aktif

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);

    }

    public function store(Request $request){
        $request->validate([
            'barang_kode'  => 'required|string|max:10|unique:m_barang,barang_kode',
            'kategori_id'  => 'required|integer',                //kategori_id harus diisi dan berupa angka
            'barang_nama'  => 'required|string|max:100',        //nama harus diisi, berupa string dan maksimal 100 karakter
            'harga_beli'  => 'required|integer',                 
            'harga_jual'  => 'required|integer'              
        ]);

        BarangModel::create([
            'barang_kode'  => $request->barang_kode,
            'kategori_id'  =>  $request->kategori_id,
            'barang_nama'  => $request->barang_nama,
            'harga_beli'  =>  $request->harga_beli,           
            'harga_jual'  => $request->harga_jual
        ]);

        return redirect('/barang')->with('success', 'Data Barang berhasil disimpan');
    }

    public function show(string $id){
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang'; //set menu yang sedang aktif

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();
    

        $breadcrumb = (object)[
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang'; //set menu yang sedang aktif

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }
    
    public function update(Request $request, string $id){
        $request->validate([
            'barang_kode '  => 'required|string|min:3|unique:m_barang,barang_kode,'.$id. ',barang_id',
            'kategori_id '  => 'required|integer',              
            'barang_nama '  => 'required|string|max:100',     
            'harga_beli'    => 'required|integer',                 
            'harga_jual'    => 'required|integer'          
        ]);

        BarangModel::find($id)->update([
            'barang_kode'   => $request->barang_kode,
            'kategori_id'   => $request->kategori_id,
            'barang_nama'   => $request->barang_nama,
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    =>  $request->harga_jual
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id) {
        $check = BarangModel::find($id);
        if(!$check){
            return redirect('/barang')->with('error', 'Data User tidak ditemukan');
        }

        try{
            BarangModel::destroy($id); //Hapus data level

            return redirect('/barang')->with('success', 'Data berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan eror
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
