<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101312">
    <title>Game toevoegen — GameSpark</title>
    <link rel="stylesheet" href="{{ asset('gamespark.css') }}">
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <a class="brand" href="{{ route('games.index') }}" aria-label="GameSpark home">
                <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 40 40" fill="none"><path d="M22.8 3 8.2 22h9.3L16 37l15.8-21h-9.6L22.8 3Z" fill="currentColor"/></svg></span>
                <span>Game<span class="brand-accent">Spark</span></span>
            </a>
            <nav class="main-nav" aria-label="Hoofdnavigatie">
                <a class="nav-link active" href="{{ route('games.index') }}">Games</a>
                <a class="nav-link" href="{{ route('games.index') }}#over-ons">Over ons</a>
            </nav>
            <button class="avatar" aria-label="Profiel"><span>J</span></button>
        </header>

        <main class="main-content">
            <button class="back-link" type="button" onclick="window.location.href='{{ route('games.index') }}'"><span>←</span> Terug naar games</button>
            <div class="form-heading">
                <p class="eyebrow">BREID JE VERZAMELING UIT</p>
                <h1>Game toevoegen</h1>
                <p>Vul de gegevens van je game in.</p>
            </div>

            <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data" class="game-form">
                @csrf
                @if ($errors->any())
                    <div class="form-errors" role="alert">
                        <strong>Controleer deze velden:</strong>
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <div class="form-grid">
                    <label class="form-field">
                        <span>Naam game <b>*</b></span>
                        <input name="name" required maxlength="120" value="{{ old('name') }}" placeholder="Bijv. The Legend of Zelda" autocomplete="off">
                    </label>
                    <label class="form-field">
                        <span>Afbeelding <b>*</b></span>
                        <div class="upload-control">
                            <input id="image" name="image" type="file" accept="image/*" required>
                            <label for="image" class="upload-label"><span id="upload-name">Upload een coverafbeelding</span><span class="upload-icon">↑</span></label>
                        </div>
                    </label>
                    <label class="form-field">
                        <span>Platform <b>*</b></span>
                        <select name="platform" required>
                            <option value="" disabled @selected(!old('platform'))>Selecteer platform</option>
                            @foreach (['PlayStation', 'PC', 'Xbox', 'Nintendo Switch'] as $platform)
                                <option value="{{ $platform }}" @selected(old('platform') === $platform)>{{ $platform }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-field">
                        <span>Genre <b>*</b></span>
                        <select name="genre" required>
                            <option value="" disabled @selected(!old('genre'))>Selecteer genre</option>
                            @foreach (['Actie', 'Avontuur', 'RPG', 'Indie', 'Strategie', 'Sport'] as $genre)
                                <option value="{{ $genre }}" @selected(old('genre') === $genre)>{{ $genre }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-field">
                        <span>Releasejaar <b>*</b></span>
                        <input name="release_year" type="number" min="1970" max="2035" required value="{{ old('release_year') }}" placeholder="Bijv. 2024">
                    </label>
                    <label class="form-field">
                        <span>Status <b>*</b></span>
                        <select name="status" required>
                            <option value="" disabled @selected(!old('status'))>Selecteer status</option>
                            @foreach (['In bezit', 'Speelt nu', 'Uitgespeeld'] as $status)
                                <option value="{{ $status }}" @selected(old('status') === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-field">
                        <span>Beoordeling (1–10) <b>*</b></span>
                        <div class="rating-input"><input name="rating" type="number" min="1" max="10" step="0.1" required value="{{ old('rating') }}" placeholder="Geef een score"><span>★</span></div>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="button button-primary">Opslaan</button>
                    <a href="{{ route('games.index') }}" class="button button-secondary">Annuleren</a>
                </div>
            </form>
        </main>
    </div>
    <script>
        document.querySelector('#image').addEventListener('change', (event) => {
            document.querySelector('#upload-name').textContent = event.target.files[0]?.name || 'Upload een coverafbeelding';
        });
    </script>
</body>
</html>
