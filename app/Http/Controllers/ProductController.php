<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Menampilkan Daftar Produk

    public function babyKid(){
        $products = [
            (object) ['code' => 'FB001', 'name' => 'Cereal', 'stock' => 100, 'price' => 5.99],
            (object) ['code' => 'FB002', 'name' => 'Juice', 'stock' => 50, 'price' => 3.49],
            (object) ['code' => 'FB003', 'name' => 'Milk', 'stock' => 75, 'price' => 2.99],
        ];

        return view('category.baby-kid', ['products' => $products]);
        return view('category.baby-kid');
    }
    public function beautyHealth(){
        $products = [
            (object) ['code' => 'FB001', 'name' => 'Cereal', 'stock' => 100, 'price' => 5.99],
            (object) ['code' => 'FB002', 'name' => 'Juice', 'stock' => 50, 'price' => 3.49],
            (object) ['code' => 'FB003', 'name' => 'Milk', 'stock' => 75, 'price' => 2.99],
        ];
        return view('category.beauty-health', ['products' => $products]);
        return view('category.beauty-health');
    }
    public function foodBeverage(){
        $products = [
            (object) ['code' => 'FB001', 'name' => 'Cereal', 'stock' => 100, 'price' => 5.99],
            (object) ['code' => 'FB002', 'name' => 'Juice', 'stock' => 50, 'price' => 3.49],
            (object) ['code' => 'FB003', 'name' => 'Milk', 'stock' => 75, 'price' => 2.99],
        ];

        return view('category.food-beverage', ['products' => $products]);
        return view('category.food-beverage');
    }
    public function homeCare(){
        $products = [
            (object) ['code' => 'FB001', 'name' => 'Cereal', 'stock' => 100, 'price' => 5.99],
            (object) ['code' => 'FB002', 'name' => 'Juice', 'stock' => 50, 'price' => 3.49],
            (object) ['code' => 'FB003', 'name' => 'Milk', 'stock' => 75, 'price' => 2.99],
        ];

        return view('category.home-care', ['products' => $products]);
        return view('category.home-care');
    }
       
}
