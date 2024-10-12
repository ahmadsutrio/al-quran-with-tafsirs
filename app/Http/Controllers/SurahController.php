<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use Illuminate\Http\Request;

class SurahController extends Controller
{
    // menampilkan halaman surah
    public function index(Request $request){
        $cekNameSurah = Surah::where('name',$request->name)->first();

        if($cekNameSurah){
            $data = Surah::where('name',$request->name)->with('ayat')->get();
            return view('surah',['data'=>$data]);
        }
        
        return redirect()->back();
    }
}
