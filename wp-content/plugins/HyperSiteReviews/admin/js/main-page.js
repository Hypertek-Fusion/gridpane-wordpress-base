import { updatePaginationControls, showPageReviews, updateButtonState } from './forms.js';

const reviewsInitializedEvent = new Event('reviewsInitialized');

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
        });
    };

    const getSelectedLocationReviews = (locationId, page = 1) => {
        return new Promise(async (resolve, reject) => {
            let reviewsBatch = [];
            let totalPages = 1;

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
                    reviewsBatch.push(r);
                });

                page++;
            } while (page <= totalPages);

            resolve(reviewsBatch);
        });
    };

    const firstReviewPage = document.getElementById('initial-reviews');
    const reviewsTable = document.getElementById('reviews-table');
    const reviewsPerPageSelect = document.getElementById('reviews-per-page');

    if (window.HSRevApi) {
        try {
            const data = await getSelectedLocation();
            const locID = data['location_id'];
            const reviews = await getSelectedLocationReviews(locID);

            const rpp = parseInt(reviewsPerPageSelect.selectedOptions[0].value, 10);
            console.log(reviews);

            firstReviewPage.innerHTML = '';

            const numPages = Math.ceil(reviews.length / rpp);

            for (let i = 0; i < numPages; i++) {
                const isFirstPage = i === 0;
                const page = isFirstPage ? firstReviewPage : document.createElement('div');
                const row = document.createElement('div');
                row.classList.add('rows');

                page.setAttribute('data-page', i + 1);
                page.classList.add('reviews-page');

                for (let j = 0; j < rpp; j++) {
                    const review = reviews[(i * rpp) + j];
                    if (!review) continue;

                    row.innerHTML += `
                        <div class="row-item review-row">
                            <input type="checkbox" name="selected-review-${review.review_id}" value="${review.review_id}" ${parseInt(review.is_selected) ? 'checked' : ''}>
                            <div class="row-item__cell" data-type="reviewer">${review.reviewer_display_name}</div>
                            <div class="row-item__cell" data-type="rating">${review.star_rating}</div>
                            <div class="row-item__cell" data-type="comment">${review.comment}</div>
                            <div class="row-item__cell" data-type="date">${new Date(review.create_time).toLocaleDateString()}</div>
                        </div>
                    `;

                    page.appendChild(row);
                }

                if (!isFirstPage) {
                    reviewsTable.appendChild(page);
                }

            }

            document.dispatchEvent(reviewsInitializedEvent);

            updatePaginationControls(reviews.length, 1, rpp);
            showPageReviews(1);
            updateButtonState();

        } catch (e) {
            console.error('Error with promise: ', e);
        }
    }
});
