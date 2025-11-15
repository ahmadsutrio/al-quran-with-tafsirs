<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    {{-- cdn font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-body-tertiary">
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-3 shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand text-success fw-bold" href="{{ route('home') }}">
                <img src="{{ @asset('images/logo.png') }}" alt="">
                Tafsir At-Thabari
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="btn btn-outline-success rounded-circle flex-shrink-0 size-25 bg-success bg-opacity-25">
                            <i class="fa-solid fa-magnifying-glass text-success "></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- end navbar --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="searchSurah" class="d-flex gap-2 align-items-center border p-2 form-control">
                        <i class="fa-solid fa-magnifying-glass text-success "></i>
                        <input type="search" class=" border-0 w-100" style="outline: none" id="searchSurah"
                            placeholder="Nama Surah">
                    </label>
                    <h6 class="my-3">Tafsir Surah</h6>
                    <ul class="w-100  p-0 e list" style="list-style: none;" id="searchResult">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <main class="container pt-5 mt-5">
        @yield('content')
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        function debounce(callback, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => callback.apply(this, args), delay);
            };
        }

        const searchInput = document.getElementById('searchSurah');

        searchInput.addEventListener('input', debounce(function() {
            const keyword = this.value;

            if (keyword.length < 2) {
                document.getElementById('searchResult').innerHTML = '';
                return;
            }

            fetch('/api/surah/search?q=' + keyword)
                .then(res => res.json())
                .then(data => {
                    const list = document.getElementById('searchResult');
                    list.innerHTML = '';

                    if (data.length === 0) {
                        list.innerHTML = '<li class="text-muted p-2">Tidak ditemukan</li>';
                        return;
                    }

                    data.forEach(item => {
                        list.innerHTML += `
                        <li>
                            <a href="/surah/${item.name}" 
                                class="text-secondary d-flex gap-2 align-items-center py-2"
                                style="text-decoration: none;">
                                ${item.name}
                            </a>
                        </li>
                    `;
                    });
                });

        }, 500));
    </script>



</body>

</html>
