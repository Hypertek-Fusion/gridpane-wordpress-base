document.addEventListener('DOMContentLoaded', function() {
    getUsers();
});

function getAccountLocationsUrl(accountId) {
    return HSRevApi.urls.accountLocationsBase.replace('%s', accountId);
}

function getReviewsUrl(accountId, locationId) {
    return HSRevApi.urls.reviewsBase
        .replace('%s', accountId)
        .replace('%s', locationId);
}

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
                    <input type="checkbox" name="selected-account">
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

    // Check if locations are already cached
    if (window.HSRevData.data.locationsCache && window.HSRevData.data.locationsCache[accountId]) {
        console.log('Using cached locations');
        populateLocations(window.HSRevData.data.locationsCache[accountId]);
        return;
    }

    try {
        locationRowsContainer.innerHTML = '';
        const loading = document.createElement('div');
        loading.style.textAlign = 'center';
        loading.innerText = 'Fetching locations. Please wait ...';
        loading.classList.add('row-item');
        locationRowsContainer.appendChild(loading);

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

        // Cache the fetched locations
        window.HSRevData.data.locationsCache = window.HSRevData.data.locationsCache || {};
        window.HSRevData.data.locationsCache[accountId] = locationsData;

        console.log('Locations for Account:', locationsData);
        populateLocations(locationsData);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

const populateLocations = async (locationsData) => {
    const locationRowsContainer = document.getElementById('location-rows');
    const locationRows = [];

    // Convert the locations object into an array
    const locationsArray = locationsData.locations;

    await Promise.all(locationsArray.map(async location => {
        if(window.HSRevData.data.accountId) {
            const reviewCount = await getLocationReviewCount(window.HSRevData.data.accountId, location.location_id);
            const locationRow = document.createElement('div');
            locationRow.classList.add('rows');
            locationRow.innerHTML = `
                <div class="row-item" data-location-id="${location.location_id}">
                    <input type="checkbox" name="selected-location">
                    <div class="row-item__cell" data-type="id">${location.location_id}</div>
                    <div class="row-item__cell" data-type="name">${location.title}</div>
                    <div class="row-item__cell" data-type="review-count">${reviewCount}</div>
                </div>
            `;
            locationRows.push(locationRow);
        }
    }));

    locationRowsContainer.innerHTML = ''; // Clear loading message
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

const getReviews = async (locationId) => {
    const reviewRowsContainer = document.getElementById('review-rows');

    // Check if reviews are already cached
    if (window.HSRevData.data.reviewsCache && window.HSRevData.data.reviewsCache[locationId]) {
        console.log('Using cached reviews');
        populateReviews(window.HSRevData.data.reviewsCache[locationId]);
        return;
    }

    try {
        reviewRowsContainer.innerHTML = '<div>Loading reviews...</div>';

        const url = HSRevApi.urls.locationReviewsBase
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

        const reviewsData = await response.json();

        // Cache the fetched reviews
        window.HSRevData.data.reviewsCache = window.HSRevData.data.reviewsCache || {};
        window.HSRevData.data.reviewsCache[locationId] = reviewsData;

        console.log('Reviews for Location:', reviewsData);
        populateReviews(reviewsData);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

// Function to populate reviews for a selected location
const populateReviews = (reviewsData) => {
    const reviewRowsContainer = document.getElementById('review-rows');
    const reviewRows = [];

    reviewsData.reviews.forEach(review => {
        const reviewRow = document.createElement('div');
        reviewRow.classList.add('rows');
        reviewRow.innerHTML = `
            <div class="row-item">
                <input type="checkbox" name="review-${review.review_id}">
                <div class="row-item__cell" data-type="reviewer">${review.reviewer_display_name}</div>
                <div class="row-item__cell" data-type="rating">${review.star_rating}</div>
                <div class="row-item__cell" data-type="comment">${review.comment}</div>
                <div class="row-item__cell" data-type="date">${new Date(review.create_time).toLocaleDateString()}</div>
            </div>
        `;
        reviewRows.push(reviewRow);
    });

    reviewRowsContainer.innerHTML = ''; // Clear loading message
    reviewRowsContainer.append(...reviewRows);

    if (window.HSRevData.functions.selectAllReviews) {
        const selectAllReviewsCheckBox = document.getElementById('select-all-reviews');
        selectAllReviewsCheckBox.addEventListener('change', () => {
            window.HSRevData.functions.selectAllReviews(selectAllReviewsCheckBox)
        })
    }
};

// Expose functions to the global scope
window.HSRevData = window.HSRevData || {};
window.HSRevData.functions = window.HSRevData.functions || {};
window.HSRevData.functions.getLocations = getLocations;
window.HSRevData.functions.getReviews = getReviews;