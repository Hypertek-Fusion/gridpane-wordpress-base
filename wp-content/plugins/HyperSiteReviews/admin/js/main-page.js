const getSelectedLocation = () => {
    return new Promise(async (resolve, reject) => {
        const response = await fetch(window.HSRevApi.urls.selectedLocation, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': HSRevApi.nonce
                }
            });

            if (!response.ok) {
                reject('Network response was not ok ' + response.statusText);
            }

            const locationsData = await response.json();

            resolve(locationsData);
        })
}

const getSelectedLocationReviews = (locationId) => {
    return new Promise(async (resolve, reject) => {
        resolve(locationId)
    })
}

document.addEventListener('DOMContentLoaded', async () => {
    if (window.HyperSiteReviews) {
        await window.HSRevData.functions.prefetchReviews();
    }
})