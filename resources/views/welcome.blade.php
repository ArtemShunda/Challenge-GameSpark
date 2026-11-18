<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101312">
    <title>GameSpark — Jouw gamecollectie</title>
    <link rel="stylesheet" href="{{ asset('gamespark.css') }}">
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <a class="brand" href="#games" aria-label="GameSpark home">
                <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 40 40" fill="none"><path d="M22.8 3 8.2 22h9.3L16 37l15.8-21h-9.6L22.8 3Z" fill="currentColor"/></svg></span>
                <span>Game<span class="brand-accent">Spark</span></span>
            </a>
            <nav class="main-nav" aria-label="Hoofdnavigatie">
                <a class="nav-link active" href="#games" data-show="games">Games</a>
                <a class="nav-link" href="#over-ons">Over ons</a>
            </nav>
            <button class="avatar" aria-label="Profiel"><span>J</span></button>
        </header>

        <main class="main-content">
            <section id="games-view" class="view">
                <div class="page-heading">
                    <div><p class="eyebrow">JOUW PERSOONLIJKE COLLECTIE</p><h1>Games <span class="count-pill" id="game-count">03</span></h1><p class="heading-copy">Al je avonturen op één plek.</p></div>
                    <button class="button button-primary" id="add-game"><span class="plus">+</span> Game toevoegen</button>
                </div>

                <section class="library-stats" aria-label="Collectie samenvatting">
                    <div class="stat-card"><span class="stat-icon icon-purple">▣</span><div><span class="stat-label">In je collectie</span><strong id="stat-total">3 games</strong></div></div>
                    <div class="stat-card"><span class="stat-icon icon-green">◉</span><div><span class="stat-label">Uitgespeeld</span><strong id="stat-completed">1 game</strong></div></div>
                    <div class="stat-card"><span class="stat-icon icon-orange">✦</span><div><span class="stat-label">Gemiddelde score</span><strong id="stat-rating">8,7 <small>/ 10</small></strong></div></div>
                </section>

                <section class="library-panel">
                    <div class="panel-heading"><div><h2>Mijn games</h2><p>Blader door je verzameling en ontdek wat je hierna gaat spelen.</p></div><label class="search-box"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 5 5"/></svg><input id="search" type="search" placeholder="Zoek een game..." aria-label="Zoek een game"></label></div>
                    <div class="filters" aria-label="Games filteren">
                        <label class="filter-field"><span>Platform</span><select id="filter-platform"><option value="">Alle platforms</option><option>PlayStation</option><option>PC</option><option>Xbox</option><option>Nintendo Switch</option></select></label>
                        <label class="filter-field"><span>Genre</span><select id="filter-genre"><option value="">Alle genres</option><option>Actie</option><option>Avontuur</option><option>RPG</option><option>Indie</option></select></label>
                        <label class="filter-field"><span>Status</span><select id="filter-status"><option value="">Alle statussen</option><option>In bezit</option><option>Speelt nu</option><option>Uitgespeeld</option></select></label>
                        <label class="filter-field"><span>Beoordeling</span><select id="filter-rating"><option value="">Alle scores</option><option value="9">9 of hoger</option><option value="8">8 of hoger</option><option value="7">7 of hoger</option></select></label>
                    </div>
                    <div class="table-wrap">
                        <table><thead><tr><th class="art-column">Afbeelding</th><th>Naam</th><th>Platform</th><th>Status</th><th>Rating</th><th class="actions-column">Acties</th></tr></thead><tbody id="game-list">
                            <tr data-name="God of War" data-platform="PlayStation" data-genre="Actie" data-status="In bezit" data-rating="9"><td><div class="game-art art-god"><span>GOD<br>OF WAR</span><i>✦</i></div></td><td><strong class="game-name">God of War</strong><small class="game-genre">Actie · Avontuur</small></td><td><span class="platform"><span class="platform-dot ps">P</span>PlayStation</span></td><td><span class="status status-owned"><i></i>In bezit</span></td><td><span class="rating"><span>★</span> 9.0</span></td><td><div class="row-actions"><button class="action-button view-game">Bekijken</button><button class="action-button edit-game">Bewerken</button><button class="action-button delete-game">Verwijderen</button></div></td></tr>
                            <tr data-name="Hollow Knight" data-platform="PC" data-genre="Indie" data-status="Speelt nu" data-rating="8"><td><div class="game-art art-hollow"><span>HOLLOW<br>KNIGHT</span><i>◇</i></div></td><td><strong class="game-name">Hollow Knight</strong><small class="game-genre">Indie · Avontuur</small></td><td><span class="platform"><span class="platform-dot pc">⌘</span>PC</span></td><td><span class="status status-playing"><i></i>Speelt nu</span></td><td><span class="rating"><span>★</span> 8.0</span></td><td><div class="row-actions"><button class="action-button view-game">Bekijken</button><button class="action-button edit-game">Bewerken</button><button class="action-button delete-game">Verwijderen</button></div></td></tr>
                            <tr data-name="Stardew Valley" data-platform="PC" data-genre="Indie" data-status="Uitgespeeld" data-rating="9"><td><div class="game-art art-stardew"><span>STARDEW<br>VALLEY</span><i>✿</i></div></td><td><strong class="game-name">Stardew Valley</strong><small class="game-genre">Indie · RPG</small></td><td><span class="platform"><span class="platform-dot pc">⌘</span>PC</span></td><td><span class="status status-completed"><i></i>Uitgespeeld</span></td><td><span class="rating"><span>★</span> 9.0</span></td><td><div class="row-actions"><button class="action-button view-game">Bekijken</button><button class="action-button edit-game">Bewerken</button><button class="action-button delete-game">Verwijderen</button></div></td></tr>
                        </tbody></table>
                        <div class="empty-state" id="empty-state" hidden><span>⌕</span><strong>Geen games gevonden</strong><p>Pas je filters aan of voeg een nieuwe game toe.</p></div>
                    </div>
                    <div class="table-footer"><span id="results-count">Je bekijkt 3 games</span><span>Gesorteerd op <strong>recent toegevoegd</strong> <span class="sort-arrows">↕</span></span></div>
                </section>
                <footer class="page-footer"><span>Gemaakt voor gamers, door gamers.</span><span>GameSpark <span class="footer-spark">✦</span></span></footer>
            </section>

            <section id="form-view" class="view" hidden>
                <button class="back-link" id="back-to-games"><span>←</span> Terug naar games</button>
                <div class="form-heading"><p class="eyebrow">BREID JE VERZAMELING UIT</p><h1 id="form-title">Game toevoegen</h1><p>Vul de gegevens van je game in.</p></div>
                <form id="game-form" class="game-form">
                    <div class="form-grid">
                        <label class="form-field"><span>Naam game <b>*</b></span><input name="name" required placeholder="Bijv. The Legend of Zelda" autocomplete="off"></label>
                        <label class="form-field"><span>Afbeelding</span><div class="upload-control"><input id="image-file" type="file" accept="image/*"><label for="image-file" class="upload-label"><span id="upload-name">Upload een coverafbeelding</span><span class="upload-icon">↑</span></label></div></label>
                        <label class="form-field"><span>Platform <b>*</b></span><select name="platform" required><option value="" disabled selected>Selecteer platform</option><option>PlayStation</option><option>PC</option><option>Xbox</option><option>Nintendo Switch</option></select></label>
                        <label class="form-field"><span>Genre <b>*</b></span><select name="genre" required><option value="" disabled selected>Selecteer genre</option><option>Actie</option><option>Avontuur</option><option>RPG</option><option>Indie</option><option>Strategie</option><option>Sport</option></select></label>
                        <label class="form-field"><span>Releasejaar <b>*</b></span><input name="year" type="number" min="1970" max="2035" required placeholder="Bijv. 2024"></label>
                        <label class="form-field"><span>Status <b>*</b></span><select name="status" required><option value="" disabled selected>Selecteer status</option><option>In bezit</option><option>Speelt nu</option><option>Uitgespeeld</option></select></label>
                        <label class="form-field"><span>Beoordeling (1–10) <b>*</b></span><div class="rating-input"><input name="rating" type="number" min="1" max="10" step="0.1" required placeholder="Geef een score"><span>★</span></div></label>
                    </div>
                    <div class="form-actions"><button type="submit" class="button button-primary">Opslaan</button><button type="button" class="button button-secondary" id="cancel-form">Annuleren</button></div>
                </form>
            </section>
            <section id="about-view" class="about-view" hidden><p class="eyebrow">OVER GAMESPARK</p><h1>Jouw games.<br><span>Jouw verhaal.</span></h1><p>GameSpark helpt je om je gamecollectie bij te houden, je voortgang te bewaren en je volgende avontuur te vinden.</p><button class="button button-primary" id="about-back">Bekijk je games <span>→</span></button></section>
        </main>
    </div>

    <dialog id="detail-dialog" class="detail-dialog"><button class="dialog-close" aria-label="Sluiten">×</button><div id="detail-content"></div></dialog>

    <template id="game-row-template"><tr><td><div class="game-art art-new"><span class="new-art-title"></span><i>✦</i></div></td><td><strong class="game-name"></strong><small class="game-genre"></small></td><td><span class="platform"><span class="platform-dot"></span><span class="platform-name"></span></span></td><td><span class="status"><i></i><span class="status-name"></span></span></td><td><span class="rating"><span>★</span><span class="rating-value"></span></span></td><td><div class="row-actions"><button class="action-button view-game">Bekijken</button><button class="action-button edit-game">Bewerken</button><button class="action-button delete-game">Verwijderen</button></div></td></tr></template>
    <script src="{{ asset('gamespark.js') }}" defer></script>
</body>
</html>
