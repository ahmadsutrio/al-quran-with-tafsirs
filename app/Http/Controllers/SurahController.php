<?php

namespace App\Http\Controllers;

use App\Models\Ayat;
use App\Models\Surah;
use Illuminate\Http\Request;

class SurahController extends Controller
{
    // menampilkan halaman surah
    public function index(Request $request)
    {
        $cekNameSurah = Surah::where('name', $request->name)->first();

        if ($cekNameSurah) {
            $ayat = Ayat::where('id_chapter', $cekNameSurah->id)
            ->with(['terjemah'=> function ($query){
                $query->where('id_translation', 174);
            },
            'verseTafsirs' => function($query){$query->where('id_tafsir', 7);}])->paginate(10);
            
            return view('surah', ['data'=>$ayat]);
        }
        
        return redirect()->back();
    }

    
}

    // $surah = Surah::where('name', $request->name)
    //     ->with(['ayat' => function ($query) {
    //         // Eager load terjemah dengan kondisi id_translation = 174
    //         $query->with(['terjemah' => function ($query) {
    //             $query->where('id_translation', 174);
    //         }]);
    //         // Eager load tafsir dengan kondisi id = 7
    //         $query->with(['verseTafsirs' => function ($query) {
    //             $query->where('id_tafsir', 7);
    //         }]);
    //     }])
    //     ->paginate(1);