document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);

    if(urlParams.get('page') && urlParams.get('page') === 'hypersite-reviews-setup') getUsers();
});

function getAccountLocationsUrl(accountId) {
    return HSRevApi.urls.accountLocationsBase.replace('%s', accountId);
}

let reviewsPage = 1;
let perPage = 10; // Default reviews per page

// Initialize selected reviews set
window.HSRevData = window.HSRevData || {};
window.HSRevData.data = window.HSRevData.data || {};
window.HSRevData.data.selectedReviews = new Set();

const getUsers = async () => {
    try {
        const accountRowsContainer = document.getElementById('account-rows');
        accountRowsContainer.innerHTML = '';
        const loading = document.createElement('div');
        loading.style.textAlign = 'center';
        loading.innerText = 'Fetching accounts. Please wait ...';
        loading.classList.add('account-row-item');
        accountRowsContainer.appendChild(loading);

        const response = await fetch(HSRevApi.urls.accounts, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': HSRevApi.nonce
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();
        console.log(data);
        populateAccounts(data);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

const populateAccounts = async (accountsData) => {
    const accountRowsContainer = document.getElementById('account-rows');
    const accountRows = [];

    await Promise.all(accountsData.accounts.map(async account => {
        const accountId = account.account_id;
        const accountLength = await getAccountLocationsLength(accountId);

        if (accountLength > 0) {
            const accountRow = document.createElement('div');
            accountRow.classList.add('rows');
            accountRow.innerHTML = `
                <div class="row-item" data-account-id="${accountId}">
                    <input type="checkbox" name="selected-account" value="${accountId}">
                    <div class="row-item__cell" data-type="name">${accountId}</div>
                    <div class="row-item__cell" data-type="account-name">${account.account_name}</div>
                    <div class="row-item__cell" data-type="type">${account.type}</div>
                    <div class="row-item__cell" data-type="location-count">${accountLength}</div>
                </div>
            `;
            accountRows.push(accountRow);
        }
    }));

    accountRowsContainer.innerHTML = '';
    accountRowsContainer.append(...accountRows);

    if (window.HSRevData.functions.attachCheckboxListeners) {
        window.HSRevData.functions.attachCheckboxListeners(accountRowsContainer);
    }
};

const getAccountLocationsLength = async (accountId) => {
    try {
        const url = HSRevApi.urls.totalAccountLocations.replace('%s', accountId.replace('accounts/', ''));
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': HSRevApi.nonce
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();
        console.log('Location length data:', data);
        return data.total || 0;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

const getLocations = async (accountId) => {
    const locationRowsContainer = document.getElementById('location-rows');
    const locationsCache = window.HSRevData.data.locationsCache || {};

    // Use cached data if available
    if (locationsCache[accountId]) {
        console.log('Using cached locations');
        populateLocations(locationsCache[accountId]);
        return;
    }

    // Show loading message
    locationRowsContainer.innerHTML = '<div style="text-align: center;" class="row-item">Fetching locations. Please wait ...</div>';

    try {
        const url = getAccountLocationsUrl(accountId.replace('accounts/', ''));
        const response = await fetch(url, {
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
        locationsCache[accountId] = locationsData;
        window.HSRevData.data.locationsCache = locationsCache;

        console.log('Locations for Account:', locationsData);
        populateLocations(locationsData);

    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        locationRowsContainer.innerHTML = '<div style="text-align: center;" class="row-item">Error fetching locations. Please try again later.</div>';
    }
};

const populateLocations = async (locationsData) => {
    const locationRowsContainer = document.getElementById('location-rows');
    const locationRows = [];

    const locationsArray = locationsData.locations;

    await Promise.all(locationsArray.map(async location => {
        if (window.HSRevData.data.accountId) {
            const reviewCount = await getLocationReviewCount(window.HSRevData.data.accountId, location.location_id);
            const locationRow = document.createElement('div');
            locationRow.classList.add('rows');
            locationRow.innerHTML = `
                <div class="row-item" data-location-id="${location.location_id}">
                    <input type="checkbox" name="selected-location" value="${location.location_id}">
                    <div class="row-item__cell" data-type="id">${location.location_id}</div>
                    <div class="row-item__cell" data-type="name">${location.title}</div>
                    <div class="row-item__cell" data-type="review-count">${reviewCount}</div>
                </div>
            `;
            locationRows.push(locationRow);
        }
    }));

    locationRowsContainer.innerHTML = '';
    locationRowsContainer.append(...locationRows);

    if (window.HSRevData.functions.attachCheckboxListeners) {
        window.HSRevData.functions.attachCheckboxListeners(locationRowsContainer);
    }
};

const getLocationReviewCount = async (accountId, locationId) => {
    try {
        const url = HSRevApi.urls.totalLocationReviews
            .replace('%s', accountId.replace('accounts/', ''))
            .replace('%s', locationId.replace('locations/', ''));
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': HSRevApi.nonce
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();
        return data.total || 0;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

// Prefetch all reviews for a location
const prefetchReviews = async (locationId) => {
    try {
        let allReviews = [];
        let page = 1;

        while (true) {
            const url = `${HSRevApi.urls.locationReviewsBase.replace('%s', locationId.replace('locations/', ''))}?page=${page}&per_page=${perPage}`;
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': HSRevApi.nonce
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }

            const reviewsData = await response.json();
            allReviews = allReviews.concat(reviewsData.reviews);

            // Break if there are no more reviews to fetch
            if (reviewsData.reviews.length < perPage) {
                break;
            }

            page++;
        }

        window.HSRevData.data.reviewsCache = window.HSRevData.data.reviewsCache || {};
        window.HSRevData.data.reviewsCache[locationId] = allReviews; // Cache all reviews

        console.log('All Reviews for Location (prefetched):', allReviews);

        // Initialize pagination
        reviewsPage = 1;
        populateReviews(reviewsPage, perPage);

    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

// Populate reviews for the current page
const populateReviews = (page, perPage) => {
    const reviewRowsContainer = document.getElementById('review-rows');
    const locationId = window.HSRevData.data.locationId;
    const reviews = window.HSRevData.data.reviewsCache[locationId] || [];
    const start = (page - 1) * perPage;
    const end = start + perPage;
    const paginatedReviews = reviews.slice(start, end);

    const reviewRows = paginatedReviews.map(review => {
        const isChecked = window.HSRevData.data.selectedReviews.has(review.review_id);
        const reviewRow = document.createElement('div');
        reviewRow.classList.add('rows');
        reviewRow.innerHTML = `
            <div class="row-item">
                <input type="checkbox" name="selected-review-${review.review_id}" value="${review.review_id}" ${isChecked ? 'checked' : ''}>
                <div class="row-item__cell" data-type="reviewer">${review.reviewer_display_name}</div>
                <div class="row-item__cell" data-type="rating">${review.star_rating}</div>
                <div class="row-item__cell" data-type="comment">${review.comment}</div>
                <div class="row-item__cell" data-type="date">${new Date(review.create_time).toLocaleDateString()}</div>
            </div>
        `;
        return reviewRow;
    });

    reviewRowsContainer.innerHTML = '';
    reviewRowsContainer.append(...reviewRows);

    updatePaginationControls(reviews.length, page, perPage);

    if (window.HSRevData.functions.selectAllReviews) {
        const selectAllReviewsCheckBox = document.getElementById('select-all-reviews');
        selectAllReviewsCheckBox.checked = paginatedReviews.every(review => window.HSRevData.data.selectedReviews.has(review.review_id));
        selectAllReviewsCheckBox.addEventListener('change', () => {
            window.HSRevData.functions.selectAllReviews(selectAllReviewsCheckBox, paginatedReviews);
            window.HSRevData.functions.attachCheckboxListeners(reviewRowsContainer);
        });
    }
};

// Update the pagination controls based on the current page and total reviews
const updatePaginationControls = (total, currentPage, perPage) => {
    const totalPages = Math.ceil(total / perPage);
    document.getElementById('reviews-prev').disabled = currentPage <= 1;
    document.getElementById('reviews-next').disabled = currentPage >= totalPages;
};

// Expose functions to the global scope
window.HSRevData = window.HSRevData || {};
window.HSRevData.functions = window.HSRevData.functions || {};
window.HSRevData.functions.getLocations = getLocations;
window.HSRevData.functions.prefetchReviews = prefetchReviews;

// Updated function to select all reviews
window.HSRevData.functions.selectAllReviews = (selectAllCheckbox, reviews) => {
    if (selectAllCheckbox.checked) {
        reviews.forEach(review => window.HSRevData.data.selectedReviews.add(review.review_id));
    } else {
        reviews.forEach(review => window.HSRevData.data.selectedReviews.delete(review.review_id));
    }
};

// Pagination UI setup
document.getElementById('reviews-per-page').addEventListener('change', function() {
    perPage = parseInt(this.value, 10);
    reviewsPage = 1; // Reset to first page on perPage change
    const locationId = window.HSRevData.data.locationId;
    if (locationId) {
        populateReviews(reviewsPage, perPage);
    }
});

document.getElementById('reviews-prev').addEventListener('click', function() {
    if (reviewsPage > 1) {
        reviewsPage--;
        const locationId = window.HSRevData.data.locationId;
        if (locationId) {
            populateReviews(reviewsPage, perPage);
        }
    }
});

document.getElementById('reviews-next').addEventListener('click', function() {
    reviewsPage++;
    const locationId = window.HSRevData.data.locationId;
    if (locationId) {
        populateReviews(reviewsPage, perPage);
    }
});
