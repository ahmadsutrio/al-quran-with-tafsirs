@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="row  row-cols-auto gap-3 mt-5 justify-content-center">
        @foreach ($data as $index => $item)
            <a href="{{ route('surah', ['name' => $item['name']]) }}" class="card border-0 bg-white text-decoration-none  col"
                style="width: 18rem;">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-block w-25 fs-6 text-center">
                        <b>{{ $index + 1 }}</b>
                    </div>
                    <div class="d-flex flex-column align-items-start justify-content-center gap-2 p-2">
                        <p class=" m-0 fs-6 fw-bold"> {{ $item['name'] }}</p>
                        <p class=" m-0 text-secondary" style="font-size: 14px;"> {{ $item['verse_count'] }} Ayat</p>
                    </div>
                    <div class="d-block w-25 text-center">
                         <p class=" m-0 amiri-regular fs-5"> {{ $item['arabic_name'] }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
