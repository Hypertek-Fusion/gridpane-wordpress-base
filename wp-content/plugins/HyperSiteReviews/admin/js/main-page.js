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

const getSelectedLocationReviews = (locationId, page = 1) => {

    return new Promise(async (resolve, reject) => {
        let reviewsBatch = []
        let totalPages = 1

        do {
            const response = await fetch(window.HSRevApi.urls.locationReviewsBase.replace('locations/%s', locationId) + '?' + new URLSearchParams({
                'per_page': 100,
                'page': page
                }), {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-WP-Nonce': HSRevApi.nonce
                    }
                });

            if (!response.ok) {
                reject('Network response was not ok ' + response.statusText);
            }

            const reviews = await response.json();

            totalPages = reviews['total_pages'];

            reviews['reviews'].array.forEach(r => {
                reviewsBatch.push(r)
            });

        } while (totalPages !== page );
            resolve(reviewsBatch);
    })
}

document.addEventListener('DOMContentLoaded', async () => {
    if (window.HSRevApi) {
        getSelectedLocation()
        .then(data => { 
            const locID = data['location_id'];
            return getSelectedLocationReviews(locID)
        })
        .then(reviews => console.log(reviews))
        .catch(e => {
            console.error('Error with promise: ', e)
        })
    }
})