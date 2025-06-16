const getSelectedLocation = async () => {
    try {
        const response = await fetch(window.HSRevApi.urls.selectedLocation, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': HSRevApi.nonce
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const locationsData = await response.json();

        return locationsData;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        locationRowsContainer.innerHTML = '<div style="text-align: center;" class="row-item">Error fetching locations. Please try again later.</div>';
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    if (window.HyperSiteReviews) {
        await window.HSRevData.functions.prefetchReviews();
    }
})