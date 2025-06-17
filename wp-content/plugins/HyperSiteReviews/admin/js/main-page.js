document.addEventListener('DOMContentLoaded', async () => {
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

            reviews['reviews'].forEach(r => {
                reviewsBatch.push(r)
            });

            page++
        } while (page <= totalPages);
            resolve(reviewsBatch);
    })
}

    const firstReviewPage = document.getElementById('initial-reviews');

    if (window.HSRevApi) {
        getSelectedLocation()
        .then(data => { 
            const locID = data['location_id'];
            return getSelectedLocationReviews(locID)
        })
        .then(reviews => {
            const reviewsTable = document.getElementById('reviews-table')
            // Reviews per page
            const rpp = parseInt(reviewsPerPageSelect.selectedOptions[0].value);
            console.log(reviews)

            // Clear the first review page
            firstReviewPage.innerHTML = '';

            // Total number of pages to generate
            const numPages = Math.ceil(reviews.length / rpp);

            for(let i = 0; i < numPages; i++) {
                const isFirstPage = i === 0;
                // Our temporary page, either the firstReviewPage, or creating a new div element
                const page = isFirstPage ? firstReviewPage : document.createElement('div');

                const row = document.createElement('div');
                row.classList.add('rows');

                // Setting the data-page attribute and reviews-page class if not already set
                page.setAttribute('data-page', i + 1);
                page.classList.add('reviews-page');

                // For every nth review, where n = reviews per page (rpp), append a row
                for(let j = 0; j < rpp; j++) {
                    const review = reviews[(i * rpp) + j];
                    if (!review) continue;
                    console.log('Review #: ', (i * rpp) + j)
                    console.log('Review Object: ', review)
                    // Create new row item
                    row.innerHTML += `
                        <div class="row-item">
                            <input type="checkbox" name="selected-review-${review.review_id}" value="${review.review_id}" ${parseInt(review.is_selected) ? 'checked' : ''}>
                            <div class="row-item__cell" data-type="reviewer">${review.reviewer_display_name}</div>
                            <div class="row-item__cell" data-type="rating">${review.star_rating}</div>
                            <div class="row-item__cell" data-type="comment">${review.comment}</div>
                            <div class="row-item__cell" data-type="date">${new Date(review.create_time).toLocaleDateString()}</div>
                        </div>
                    `;

                    page.appendChild(row);
                }

                // If this is not the firstReview page, insert it after the initial firstReviewPage
                if( !isFirstPage ) {
                    reviewsTable.appendChild(page)
                } else {
                    continue;
                }

            }

            // Setup pagination after populating reviews
            updatePaginationControls(reviews.length, 1, rpp);
            showPageReviews(1);

        })
        .catch(e => {
            console.error('Error with promise: ', e)
        })
    }
})
