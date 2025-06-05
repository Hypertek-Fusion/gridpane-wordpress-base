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

    await Promise.all(Object.keys(accountsData.accounts).map(async accountKey => {
        const account = accountsData.accounts[accountKey];
        const accountLength = await getAccountLocationsLength(account.name);

        if (accountLength > 0) {
            const accountRow = document.createElement('div');
            accountRow.classList.add('rows');
            accountRow.innerHTML = `
                <div class="row-item" data-account-id="${account.name}">
                    <input type="checkbox" name="selected-account">
                    <div class="row-item__cell" data-type="name">${account.name}</div>
                    <div class="row-item__cell" data-type="account-name">${account.accountName}</div>
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

const getAccountLocationsLength = async (accountName) => {
    try {
        const url = HSRevApi.urls.totalAccountLocations.replace('%s', accountName.replace('accounts/', ''));
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

// Function to fetch locations for a selected account
const getLocations = async (accountId) => {
    try {
        const locationRowsContainer = document.getElementById('location-rows');
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
        console.log('Locations for Account:', locationsData);
        populateLocations(locationsData); // Call populateLocations with the data
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

// Function to populate locations for a selected account
const populateLocations = async (locationsData) => {
    const locationRowsContainer = document.getElementById('location-rows');
    const locationRows = [];

    // Convert the locations object into an array
    const locationsArray = Object.keys(locationsData.locations).map(locationKey => locationsData.locations[locationKey]);

    await Promise.all(locationsArray.map(async location => {
        const reviewCount = await getLocationReviewCount(location.name); // Example function to get review count

        const locationRow = document.createElement('div');
        locationRow.classList.add('row-item');
        locationRow.innerHTML = `
            <div class="row-item" data-location-id="${location.name}">
                <input type="checkbox" name="selected-location">
                <div class="row-item__cell" data-type="id">${location.name}</div>
                <div class="row-item__cell" data-type="name">${location.title}</div>
                <div class="row-item__cell" data-type="review-count">${reviewCount}</div>
            </div>
        `;
        locationRows.push(locationRow);
    }));

    locationRowsContainer.innerHTML = ''; // Clear loading message
    locationRowsContainer.append(...locationRows);

    if (window.HSRevData.functions.attachCheckboxListeners) {
        window.HSRevData.functions.attachCheckboxListeners(locationRowsContainer);
    }
};

// Example function to get review count for a location
const getLocationReviewCount = async (locationId) => {
    // Implement the logic to fetch the review count for a location
    return Math.floor(Math.random() * 100); // Placeholder for demonstration
};


// Expose functions to the global scope
window.HSRevData = window.HSRevData || {};
window.HSRevData.functions = window.HSRevData.functions || {};
window.HSRevData.functions.getLocations = getLocations;
