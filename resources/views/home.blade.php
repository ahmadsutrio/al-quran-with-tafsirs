@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="row  row-cols-auto gap-3 mt-5 justify-content-center">

        @foreach ($data as $item)
            <a href="{{ route('surah',['name'=>$item['name']]) }}" class="card text-decoration-none col" style="width: 18rem;">
                <div class="card-body ">
                    <p class="card-text"> {{ $item['name'] }}</p>
                    <p class="card-text"> {{ $item['arabic_name'] }}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
