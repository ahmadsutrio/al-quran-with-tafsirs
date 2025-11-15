@extends('layouts.app')
@section('title')
    Surah
@endsection
@section('content')
{{-- @dd($data) --}}
    @foreach ($data as $ayat)
        <div class="card text-decoration-none text-end my-3">
            <div class="card-body w-100 ">
                <p class="card-text"> {{ $ayat['text_uthmani'] }} ( {{ $ayat['number'] }} )</p>
                @foreach ($ayat->terjemah as $terjemah)
                    <p class="card-text"> {{ $terjemah['text'] }}</p>
                @endforeach
                @foreach ($ayat->verseTafsirs as $tafsir)
                    <p class="card-text text-break" style="text-align: justify"> {!! $tafsir['text'] !!}</p>
                @endforeach
            </div>
        </div>
    @endforeach

    {{ $data->links() }}
@endsection
