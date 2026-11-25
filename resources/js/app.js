const list = document.querySelector('#game-list');

if (list) {
    const search = document.querySelector('#search');
    const emptyState = document.querySelector('#empty-state');

    function filterGames() {
        const query = search.value.trim().toLocaleLowerCase('nl');
        const filters = {
            platform: document.querySelector('#filter-platform').value,
            genre: document.querySelector('#filter-genre').value,
            status: document.querySelector('#filter-status').value,
            rating: Number(document.querySelector('#filter-rating').value || 0),
        };
        const rows = [...list.querySelectorAll('tr:not(.no-games)')];
        let visibleCount = 0;

        rows.forEach((row) => {
            const matches = row.dataset.name.toLocaleLowerCase('nl').includes(query)
                && (!filters.platform || row.dataset.platform === filters.platform)
                && (!filters.genre || row.dataset.genre === filters.genre)
                && (!filters.status || row.dataset.status === filters.status)
                && Number(row.dataset.rating) >= filters.rating;
            row.hidden = !matches;
            if (matches) visibleCount++;
        });

        const filtersAreActive = query || filters.platform || filters.genre || filters.status || filters.rating;
        emptyState.hidden = visibleCount > 0 || rows.length === 0 || !filtersAreActive;
        document.querySelector('#results-count').textContent = `Je bekijkt ${visibleCount} ${visibleCount === 1 ? 'game' : 'games'}`;
    }

    document.querySelectorAll('.filter-field select').forEach((select) => select.addEventListener('change', filterGames));
    search.addEventListener('input', filterGames);
}
