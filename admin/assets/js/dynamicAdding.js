document.addEventListener('DOMContentLoaded', function () {
    const addEpisodeBtn = document.getElementById('addEpisodeBtn');
    const episodeContainer = document.getElementById('episodeContainer');
    const maxEpisodes = <?= $data['season_eps']; ?>; 

    let addedEpisodes = <?= isset($_SESSION['addedEpisodes']) ? $_SESSION['addedEpisodes'] : 1; ?>;

    addEpisodeBtn.addEventListener('click', function () {
        if (addedEpisodes < maxEpisodes) {
            const clone = episodeContainer.cloneNode(true);
            episodeContainer.parentNode.appendChild(clone);

            const lastRow = document.querySelectorAll('.episode-container')[addedEpisodes];
            const episodeNumberInput = lastRow.querySelector('[name="episode_number[]"]');
            const episodeNameInput = lastRow.querySelector('[name="name[]"]');
            const episodeSlugInput = lastRow.querySelector('[name="slug[]"]');

            const seriesId = <?= $data['series_id']; ?>;
            const seasonNumber = <?= $data['season_number']; ?>;
            episodeNumberInput.value = addedEpisodes + 1;
            episodeNameInput.value = 'Episode ' + (addedEpisodes + 1);
            episodeSlugInput.value = `${seriesId}-${seasonNumber}-${episodeNameInput.value.toLowerCase().replace(/\s+/g, '-')}`;
            // Update the season_id and series_id hidden inputs
            document.querySelector('[name="season_id"]').value = <?= $seasonId; ?>;
            document.querySelector('[name="series_id"]').value = seriesId;

            addedEpisodes++;
           
        } else {
            alertify.error('Maximum number of episodes reached.');
            return;
        }
        alertify.success('Episode added successfully!');
    });

    const uploadBtn = document.getElementById('uploadBtn');
    uploadBtn.addEventListener('click', function () {
        episodeForm.submit();
    });
});