<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    // menampilkan halaman awal
    public function index(Request $request)
    {
        $data = Surah::all();

        if ($request->search) {
            $keyword = strtolower($request->search);

            $data = $data->filter(function ($item) use ($keyword) {
                return str_contains(strtolower($item->name), $keyword)
                    || str_contains(strtolower($item->arabic_name), $keyword);
            });
        }

        return view('home', [
            'data' => $data
        ]);
    }
}
