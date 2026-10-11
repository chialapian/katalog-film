<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Film Alicia</title>
</head>
<body>
    <h1>Katalog Film</h1>

        <form action="{{ route('films.index') }}" method="GET">
    <input
        type="text"
        name="search"
        placeholder="Cari judul, sutradara, atau genre..."
        value="{{ $search ?? '' }}"
    >

    <button type="submit">Cari</button>

    <a href="{{ route('films.index') }}">Reset</a>
</form>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <p>
        <a href="{{ route('films.create') }}">+ Tambah Film</a>
    </p>

    @forelse ($films as $film)
        <article>
            <h2>
                <a href="{{ route('films.show', $film) }}">
                    {{ $film->title }}
                </a>
            </h2>

            <p>Sutradara: {{ $film->director }}</p>
            <p>Genre: {{ $film->genre }}</p>
            <p>Tahun Rilis: {{ $film->release_year }}</p>
        </article>
        <hr>
    @empty
        <p>Belum ada data film.</p>
    @endforelse

    <div>
    <p>
        Menampilkan {{ $films->firstItem() }}–{{ $films->lastItem() }}
        dari {{ $films->total() }} film
    </p>

    @if ($films->onFirstPage())
        <span>Sebelumnya</span>
    @else
        <a href="{{ $films->previousPageUrl() }}">Sebelumnya</a>
    @endif

    @for ($page = 1; $page <= $films->lastPage(); $page++)
        @if ($page == $films->currentPage())
            <strong>{{ $page }}</strong>
        @else
            <a href="{{ $films->url($page) }}">{{ $page }}</a>
        @endif
    @endfor

    @if ($films->hasMorePages())
        <a href="{{ $films->nextPageUrl() }}">Selanjutnya</a>
    @else
        <span>Selanjutnya</span>
    @endif
</div>
</body>
</html>