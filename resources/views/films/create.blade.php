<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film - Katalog Film Alicia</title>
</head>
<body>
    <h1>Tambah Film Baru</h1>

    @if ($errors->any())
        <div>
            <h3>Data belum valid. Periksa kembali:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('films.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Judul Film:</label><br>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
                maxlength="255"
            >
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="director">Sutradara:</label><br>
            <input
                type="text"
                id="director"
                name="director"
                value="{{ old('director') }}"
                required
                maxlength="255"
            >
            @error('director')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="genre">Genre:</label><br>
            <input
                type="text"
                id="genre"
                name="genre"
                value="{{ old('genre') }}"
                required
                maxlength="100"
            >
            @error('genre')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="release_year">Tahun Rilis:</label><br>
            <input
                type="number"
                id="release_year"
                name="release_year"
                value="{{ old('release_year') }}"
                min="1888"
                max="2026"
                required
            >
            @error('release_year')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="duration">Durasi (menit):</label><br>
            <input
                type="number"
                id="duration"
                name="duration"
                value="{{ old('duration') }}"
                min="1"
                max="65535"
                required
            >
            @error('duration')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="synopsis">Sinopsis:</label><br>
            <textarea
                id="synopsis"
                name="synopsis"
                rows="5"
            >{{ old('synopsis') }}</textarea>
            @error('synopsis')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Simpan Film</button>
    </form>

    <p>
        <a href="{{ route('films.index') }}">Kembali ke daftar film</a>
    </p>
</body>
</html>