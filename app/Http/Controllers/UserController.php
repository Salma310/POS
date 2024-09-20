<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    // Praktikum 2.6 – Create, Read, Update, Delete (CRUD)
        $user = UserModel::all();
        return view('user', ['data' => $user]);

    // Praktikum 2.5 – Attribute Changes
    // Nomor 2
        // $user = UserModel::create([
        //         'username' => 'manager11',
        //         'nama' => 'Manager Sebelas',
        //         'level_id' => 2,
        //         'password' => Hash::make('12345')
        //     ]);
        // $user->username = 'manager12';

        // $user->save();

        // $user->wasChanged(); //true
        // $user->wasChanged('username'); //true
        // $user->wasChanged('username', 'level_id'); //true
        // $user->wasChanged('nama'); //false
        // dd($user->wasChanged(['nama', 'username']));
      

    // Nomor 1
        // $user = UserModel::create([
        //         'username' => 'manager55',
        //         'nama' => 'Manager Lima Lima',
        //         'level_id' => 2,
        //         'password' => Hash::make('12345')
        //     ]);
        // $user->username = 'manager56';

        // $user->isDirty(); //true
        // $user->isDirty('username');  //true
        // $user->isDirty('nama'); //false
        // $user->isDirty('nama', 'username'); //true
        // $user->isClean(); //false
        // $user->isClean('username'); //false
        // $user->isClean('nama');  //true
        // $user->isClean('nama', 'username'); //false

        // $user->save();

        // $user->isDirty(); //false
        // $user->isClean(); //true
        // dd($user->isDirty());
    
    // Praktikum 2.4 JS4 : Retreiving or Creating Models

        //  $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'level_id' => 2,
        //         'password' => Hash::make('12345')
        //     ],
        // );
        // $user->save();
        // return view('user', ['data' => $user]);


        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );
        // return view('user', ['data' => $user]);


        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'level_id' => 2,
        //         'password' => Hash::make('12345')
        //     ],
        // );
        // return view('user', ['data' => $user]);
        
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager'
        //     ],
        // );
        // return view('user', ['data' => $user]);

    // Praktikum 2.3 JS4 : Retreiving Aggregrates
        // $user= UserModel::where('level_id', 2)->count();
        // dd($user);
        // return view('user', ['data' => $user]);



    //Praktikum 2.2 JS4 : Not Found Exceptions
        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // $user = UserModel::findOrFail(1);
        // return view('user', ['data' => $user]);

    
    //Praktikum 2.1 JS4 :  Retrieving Single Models
        // $user = UserModel::findOr(20, ['username', 'nama'], function(){
        //     abort(404);
        // });
        // $user= UserModel::where('level_id', 1)->first();
        // $user= UserModel::find(1);

        // $user= UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);

        //Praktikum 1 JS4
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'manager',
        //     'password' => Hash::make('12345')
        // ];
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        
    //JOBSHEET 3
        //coba akses model UserModel
        // $user = UserModel::all(); //Ambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);
        
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

    public function tambah(){
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request){
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' =>$request->level_id
        ]);
        return redirect('/user');
    }
    
    public function ubah($id){
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request){
        $user = UserModel::find($id);

            $user->username = $request->username;
            $user->nama = $request->nama;
            $user->password = Hash::make('$request->password');
            $user->level_id = $request->level_id;
            $user->save();

        return redirect('/user');
    }

    public function hapus($id){
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }

}
