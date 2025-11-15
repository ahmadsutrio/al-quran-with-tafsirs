<?php

namespace App\Http\Controllers;

use App\Models\Ayat;
use App\Models\Surah;
use Illuminate\Http\Request;

class SurahController extends Controller
{
    public function index(Request $request)
    {
        $cekNameSurah = Surah::where('name', $request->name)->first();

        if (! $cekNameSurah) {
            return redirect()->back();
        }

        // Previous & next surah
        $previousSurah = Surah::where('id', '<', $cekNameSurah->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextSurah = Surah::where('id', '>', $cekNameSurah->id)
            ->orderBy('id', 'asc')
            ->first();

        // Ambil ayat paginate 10
        $ayat = Ayat::where('id_chapter', $cekNameSurah->id)
            ->with([
                'terjemah' => function ($query) {
                    $query->where('id_translation', 174);
                },
                'verseTafsirs' => function ($query) {
                    $query->where('id_tafsir', 7);
                }
            ])
            ->paginate(10);

        // Untuk dropdown ayat → halaman
        $perPage = $ayat->perPage();

        // Bersihkan teks
        $ayat->getCollection()->transform(function ($item) {

            // fungsi untuk merapikan semua teks
            $clean = function ($text) {
                if (!$text) return $text;

                // hilangkan escape slash
                $text = stripslashes($text);

                // [TAMBAH BARIS INI] ganti string 'rn' menjadi string kosong
                $text = str_replace("rn", "", $text);

                // ganti newline jadi <br>
                $text = str_replace(["\r\n", "\n", "\r"], "<br>", $text);

                return $text;
            };

            // text uthmany
            if (isset($item->text_uthmany)) {
                $item->text_uthmany = $clean($item->text_uthmany);
            }

            // terjemahan
            if (isset($item->terjemah->text)) {
                $item->terjemah->text = $clean($item->terjemah->text);
            }

            // tafsir
            if (isset($item->verseTafsirs) && $item->verseTafsirs->isNotEmpty()) {
                foreach ($item->verseTafsirs as $taf) {
                    $taf->text = $clean($taf->text);
                }
            }

            return $item;
        });

        return view('surah', [
            'data'       => $ayat,
            'prevSurah'  => $previousSurah,
            'nextSurah'  => $nextSurah,
            'dataSurah'  => $cekNameSurah,
            'perPage'    => $perPage,
        ]);
    }

    public function searchSurah(Request $request)
    {
        $keyword = $request->q;

        $data = Surah::where('name', 'like', "%{$keyword}%")
            ->limit(10)
            ->get();

        return response()->json($data);
    }
}
