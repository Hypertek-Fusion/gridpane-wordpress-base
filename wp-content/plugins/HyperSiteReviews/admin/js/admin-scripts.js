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
                <div class="account-row-item" data-account-id="${account.name}">
                    <input type="checkbox" name="selected-account">
                    <div class="account-row-item__cell" data-type="name">${account.name}</div>
                    <div class="account-row-item__cell" data-type="account-name">${account.accountName}</div>
                    <div class="account-row-item__cell" data-type="type">${account.type}</div>
                    <div class="account-row-item__cell" data-type="location-count">${accountLength}</div>
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
        const url = getAccountLocationsUrl(accountId.replace('%s', accountName.replace('accounts/', '')));
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
const populateLocations = (locationsData) => {
    const locationRowsContainer = document.getElementById('location-rows');
    locationRowsContainer.innerHTML = '';
    const loading = document.createElement('div');
    loading.style.textAlign = 'center';
    loading.innerText = 'Fetching locations. Please wait ...';
    loading.classList.add('location-row-item');
    locationRowsContainer.appendChild(loading);

    locationRowsContainer.innerHTML = ''; // Clear loading message

    locationsData.forEach(location => {
        const locationRow = document.createElement('div');
        locationRow.classList.add('rows');
        locationRow.innerHTML = `
            <div class="location-row-item" data-location-id="${location.name}">
                <input type="checkbox" name="selected-location">
                <div class="location-row-item__cell" data-type="id">${location.name}</div>
                <div class="location-row-item__cell" data-type="name">${location.title}</div>
                <div class="location-row-item__cell" data-type="review-count">Loading...</div>
            </div>
        `;
        locationRowsContainer.appendChild(locationRow);
    });

    if (window.HSRevData.functions.attachCheckboxListeners) {
        window.HSRevData.functions.attachCheckboxListeners(locationRowsContainer);
    }
};

// Expose functions to the global scope
window.HSRevData = window.HSRevData || {};
window.HSRevData.functions = window.HSRevData.functions || {};
window.HSRevData.functions.getLocations = getLocations;
