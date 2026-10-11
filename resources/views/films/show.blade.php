<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $film->title }} - Katalog Film Alicia</title>
</head>
<body>
    <h1>{{ $film->title }}</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <p><strong>Sutradara:</strong> {{ $film->director }}</p>
    <p><strong>Genre:</strong> {{ $film->genre }}</p>
    <p><strong>Tahun Rilis:</strong> {{ $film->release_year }}</p>
    <p><strong>Durasi:</strong> {{ $film->duration }} menit</p>

    <h2>Sinopsis</h2>
    <p>{{ $film->synopsis ?? 'Sinopsis belum tersedia.' }}</p>

    <p>
        <a href="{{ route('films.edit', $film) }}">Edit Film</a>
    </p>

    <hr>

    <h2>Hapus Film</h2>
    <p>Penghapusan film tidak dapat dibatalkan.</p>

    <form
        action="{{ route('films.destroy', $film) }}"
        method="POST"
        onsubmit="return confirm('Yakin ingin menghapus film ini?');"
    >
        @csrf
        @method('DELETE')

        <button type="submit">Hapus Film</button>
    </form>

    <p>
        <a href="{{ route('films.index') }}">Kembali ke daftar film</a>
    </p>
</body>
</html>