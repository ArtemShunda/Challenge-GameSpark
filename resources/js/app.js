const gamesView = document.querySelector('#games-view');
const formView = document.querySelector('#form-view');
const aboutView = document.querySelector('#about-view');
const form = document.querySelector('#game-form');
const list = document.querySelector('#game-list');
const template = document.querySelector('#game-row-template');
const dialog = document.querySelector('#detail-dialog');
let editingRow = null;

function showView(view) {
    gamesView.hidden = view !== 'games';
    formView.hidden = view !== 'form';
    aboutView.hidden = view !== 'about';
    document.querySelectorAll('.nav-link').forEach((link) => link.classList.toggle('active', link.dataset.show === view || (view === 'form' && link.dataset.show === 'games')));
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function openForm(row = null) {
    editingRow = row;
    form.reset();
    document.querySelector('#upload-name').textContent = 'Upload een coverafbeelding';
    document.querySelector('#form-title').textContent = row ? 'Game bewerken' : 'Game toevoegen';
    if (row) {
        form.elements.name.value = row.dataset.name;
        form.elements.platform.value = row.dataset.platform;
        form.elements.genre.value = row.dataset.genre;
        form.elements.status.value = row.dataset.status;
        form.elements.year.value = row.dataset.year || '';
        form.elements.rating.value = row.dataset.rating;
    }
    showView('form');
    form.elements.name.focus({ preventScroll: true });
}

function updateSummary() {
    const rows = [...list.querySelectorAll('tr')];
    const visibleRows = rows.filter((row) => !row.hidden);
    const completed = rows.filter((row) => row.dataset.status === 'Uitgespeeld').length;
    const average = rows.length ? rows.reduce((sum, row) => sum + Number(row.dataset.rating), 0) / rows.length : 0;
    document.querySelector('#game-count').textContent = String(rows.length).padStart(2, '0');
    document.querySelector('#stat-total').textContent = `${rows.length} ${rows.length === 1 ? 'game' : 'games'}`;
    document.querySelector('#stat-completed').textContent = `${completed} ${completed === 1 ? 'game' : 'games'}`;
    document.querySelector('#stat-rating').innerHTML = `${average.toLocaleString('nl-NL', { minimumFractionDigits: 1, maximumFractionDigits: 1 })} <small>/ 10</small>`;
    document.querySelector('#results-count').textContent = `Je bekijkt ${visibleRows.length} ${visibleRows.length === 1 ? 'game' : 'games'}`;
    document.querySelector('#empty-state').hidden = visibleRows.length !== 0;
}

function filterGames() {
    const query = document.querySelector('#search').value.trim().toLocaleLowerCase('nl');
    const filters = {
        platform: document.querySelector('#filter-platform').value,
        genre: document.querySelector('#filter-genre').value,
        status: document.querySelector('#filter-status').value,
        rating: Number(document.querySelector('#filter-rating').value || 0),
    };
    list.querySelectorAll('tr').forEach((row) => {
        const matches = row.dataset.name.toLocaleLowerCase('nl').includes(query)
            && (!filters.platform || row.dataset.platform === filters.platform)
            && (!filters.genre || row.dataset.genre === filters.genre)
            && (!filters.status || row.dataset.status === filters.status)
            && Number(row.dataset.rating) >= filters.rating;
        row.hidden = !matches;
    });
    updateSummary();
}

function bindRow(row) {
    row.querySelector('.delete-game').addEventListener('click', () => {
        row.remove();
        filterGames();
    });
    row.querySelector('.edit-game').addEventListener('click', () => openForm(row));
    row.querySelector('.view-game').addEventListener('click', () => {
        const title = row.dataset.name;
        document.querySelector('#detail-content').innerHTML = `<p class="eyebrow">JOUW COLLECTIE</p><h2></h2><p class="detail-description"></p><div class="detail-meta"></div>`;
        document.querySelector('#detail-content h2').textContent = title;
        document.querySelector('.detail-description').textContent = `${row.dataset.name} is een ${row.dataset.genre.toLowerCase()} game voor ${row.dataset.platform}. ${row.dataset.year ? `Uitgebracht in ${row.dataset.year}.` : ''}`;
        document.querySelector('.detail-meta').innerHTML = `<span>${row.dataset.platform}</span><span>${row.dataset.status}</span><span>★ ${Number(row.dataset.rating).toFixed(1)} / 10</span>`;
        dialog.showModal();
    });
}

document.querySelector('#add-game').addEventListener('click', () => openForm());
document.querySelector('#back-to-games').addEventListener('click', () => showView('games'));
document.querySelector('#cancel-form').addEventListener('click', () => showView('games'));
document.querySelector('#about-back').addEventListener('click', () => showView('games'));
document.querySelectorAll('.nav-link').forEach((link) => link.addEventListener('click', (event) => {
    if (link.dataset.show) {
        event.preventDefault();
        showView(link.dataset.show);
    } else {
        event.preventDefault();
        showView('about');
    }
}));
document.querySelectorAll('.filter-field select').forEach((select) => select.addEventListener('change', filterGames));
document.querySelector('#search').addEventListener('input', filterGames);
document.querySelector('#image-file').addEventListener('change', (event) => {
    document.querySelector('#upload-name').textContent = event.target.files[0]?.name || 'Upload een coverafbeelding';
});
document.querySelector('.dialog-close').addEventListener('click', () => dialog.close());
dialog.addEventListener('click', (event) => { if (event.target === dialog) dialog.close(); });

form.addEventListener('submit', (event) => {
    event.preventDefault();
    if (!form.reportValidity()) return;
    const values = Object.fromEntries(new FormData(form).entries());
    const row = editingRow || template.content.firstElementChild.cloneNode(true);
    row.dataset.name = values.name.trim();
    row.dataset.platform = values.platform;
    row.dataset.genre = values.genre;
    row.dataset.status = values.status;
    row.dataset.rating = values.rating;
    row.dataset.year = values.year;
    row.querySelector('.game-name').textContent = values.name.trim();
    row.querySelector('.game-genre').textContent = `${values.genre} · ${values.year}`;
    row.querySelector('.platform-name').textContent = values.platform;
    row.querySelector('.platform-dot').textContent = values.platform === 'PlayStation' ? 'P' : values.platform === 'PC' ? '⌘' : values.platform === 'Xbox' ? 'X' : 'N';
    row.querySelector('.status-name').textContent = values.status;
    row.querySelector('.rating-value').textContent = Number(values.rating).toFixed(1);
    const statusClass = values.status === 'Uitgespeeld' ? 'status-completed' : values.status === 'Speelt nu' ? 'status-playing' : 'status-owned';
    row.querySelector('.status').className = `status ${statusClass}`;
    const art = row.querySelector('.game-art');
    art.className = `game-art ${editingRow ? art.classList.contains('art-new') ? 'art-new' : art.classList[1] : 'art-new'}`;
    art.querySelector('span').textContent = values.name.toUpperCase();
    if (!editingRow) list.prepend(row);
    if (!editingRow) bindRow(row);
    form.reset();
    filterGames();
    showView('games');
});

list.querySelectorAll('tr').forEach(bindRow);
updateSummary();
