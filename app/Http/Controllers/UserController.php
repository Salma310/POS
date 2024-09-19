<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //JOBSHEET 2
    // public function profile($id, $name){
    //     return view('user', ['id' => $id, 'name' => $name]);
    // }

    public function index(){

    //JOBSHEET 4

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'manager',
        //     'password' => Hash::make('12345')
        // ];
        $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345')
        ];
        UserModel::create($data);

        
    //JOBSHEET 3
        //coba akses model UserModel
        $user = UserModel::all(); //Ambil semua data dari tabel m_user
        return view('user', ['data' => $user]);
        
       // tambah data user dengan Eloquent Model
        // $data = [
        //     'username' => 'customer-1',
        //     'nama'  => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4
        // ];
        // UserModel::insert($data); //tambahkan data ke tabel m_user

        // $data = [
        //     'nama'  => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data); //update data user
        
        
    }
}
