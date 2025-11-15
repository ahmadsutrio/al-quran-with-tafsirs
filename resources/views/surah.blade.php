@extends('layouts.app2')
@section('title')
    Surah
@endsection
@section('previous_surah')
    @if ($prevSurah)
        <a class="navbar-brand bg-white py-2 rounded-1 px-5 d-flex align-items-center gap-2"
            href="{{ route('surah', ['name' => $prevSurah['name'] ?? '/']) }}">
            <i class="fa-solid fa-angle-left text-success"></i>
            {{ $prevSurah['name'] }}
        </a>
    @endif
@endsection
@section('next_surah')
    @if ($nextSurah)
        <a class="navbar-brand bg-white py-2 rounded-1 px-5 d-flex align-items-center gap-2"
            href="{{ route('surah', ['name' => $nextSurah['name']]) }}">
            {{ $nextSurah['name'] }}
            <i class="fa-solid fa-angle-right text-success"></i>
        </a>
    @endif
@endsection


@section('count_ayat_mobile')
    <select id="select-ayat-mobile" class="form-select">
        <option value="">Pilih Ayat</option>
        @for ($i = 1; $i <= $dataSurah['verse_count']; $i++)
            @php $page = ceil($i / $perPage); @endphp
            <option value="ayat-{{ $i }}" data-page="{{ $page }}">Ayat {{ $i }}</option>
        @endfor
    </select>
@endsection

@section('count_ayat_desktop')
    <select id="select-ayat-desktop" class="form-select">
        <option value="">Pilih Ayat</option>
        @for ($i = 1; $i <= $dataSurah['verse_count']; $i++)
            @php $page = ceil($i / $perPage); @endphp
            <option value="ayat-{{ $i }}" data-page="{{ $page }}">Ayat {{ $i }}</option>
        @endfor
    </select>
@endsection


@section('script')
    <script>
        const selectElDesktop = document.getElementById('select-ayat-desktop');
        const selectElMobile = document.getElementById('select-ayat-mobile');

        if (selectElDesktop) {
            selectElDesktop.addEventListener('change', function() {
                const anchor = this.value;
                const page = this.selectedOptions[0]?.dataset.page;

                // console.log("DESKTOP CHANGE", anchor, page);

                if (page && anchor) {
                    window.location.href = `?page=${page}#${anchor}`;
                }
            });
        }

        if (selectElMobile) {
            selectElMobile.addEventListener('change', function() {
                const anchor = this.value;
                const page = this.selectedOptions[0]?.dataset.page;

                // console.log("MOBILE CHANGE", anchor, page);

                if (page && anchor) {
                    window.location.href = `?page=${page}#${anchor}`;
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="mx-auo text-center my-4">
        <h2 class=" mb-0">{{ $dataSurah['name'] }}</h2>
        <p class="mt-0 ">{{ $dataSurah['revelation_place'] }} . {{ $dataSurah['verse_count'] }} Ayat</p>
    </div>

    @foreach ($data as $ayat)
        <div class="card border-0 text-decoration-none text-end my-3" id="ayat-{{ $ayat['number'] }}">
            <div class="card-body w-100 ">
                <p class="card-text amiri-regular fw-medium fs-2 lh-lg"> {{ $ayat['text_uthmani'] }} (
                    {{ $ayat['number'] }}
                    )</p>
                @foreach ($ayat->terjemah as $terjemah)
                    <p class="card-text text-secondary fs-5"> {{ $ayat['transliteration'] }}</p>
                    <p class="card-text fs-5"> {{ $terjemah['text'] }}</p>
                @endforeach
                @if ($ayat->verseTafsirs->isNotEmpty())
                    <h3 class="text-start">Tafsiran:</h3>
                @endif
                @foreach ($ayat->verseTafsirs as $tafsir)
                    <p class="card-text text-break" style="text-align: justify"> {!! $tafsir['text'] !!}</p>
                @endforeach
            </div>
        </div>
    @endforeach

    {{ $data->links() }}
@endsection
