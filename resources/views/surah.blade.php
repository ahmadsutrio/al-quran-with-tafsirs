@extends('layouts.app')
@section('title')
    Surah 
@endsection
@section('content')
    @foreach ($data as $items)
    @foreach ($items->ayat as $item)
        <div class="card text-decoration-none text-end" >
                <div class="card-body w-100 ">
                    <p class="card-text"> {{ $item['text_uthmani'] }}</p>
                    {{-- <p class="card-text"> {{ $item['text_imlaei'] }}</p> --}}
                </div>
            </div>
    @endforeach
    @endforeach
@endsection