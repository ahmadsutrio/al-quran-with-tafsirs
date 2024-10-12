<?php

namespace App\Http\Controllers;

use App\Models\Surah;

class HomeController extends Controller
{
    // menampilkan halaman awal
    public function index(){
        $data = Surah::get(['name','arabic_name']);
        return view('home',['data'=>$data]);
    }
}
