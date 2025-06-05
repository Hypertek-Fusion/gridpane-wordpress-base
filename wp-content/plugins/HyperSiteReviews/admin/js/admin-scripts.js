document.addEventListener('DOMContentLoaded', function() {
    getUsers();
});

function getAccountLocationsUrl(accountId) {
    return HSRevApi.urls.accountLocationsBase.replace('%s', accountId);
}

// Function to construct the reviews URL
function getReviewsUrl(accountId, locationId) {
    return HSRevApi.urls.reviewsBase
        .replace('%s', accountId)
        .replace('%s', locationId);
}

const getUsers = async () => {
    try {

        const accountRowsContainer = document.getElementById('account-rows');
        const loading = createElement('div');
        loading.style.textAlign = 'center';
        loading.style.verticalAlign = 'center';
        loading.innerText = 'Fetching accounts. Please wait ...';
        accountRowsContainer.appendChild(loading)

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
        populateAccounts(data);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

const populateAccounts = (accounts) => {
    const accountRowsContainer = document.getElementById('account-rows');
    accountRowsContainer.innerHTML = ''; // Clear existing content

    accounts.forEach(account => {
        const accountRow = document.createElement('div');
        accountRow.classList.add('rows');
        accountRow.innerHTML = `
            <div class="account-row-item" data-account-id="${account.name}">
                <input type="checkbox" name="selected-account">
                <div class="account-row-item__cell" data-type="name">${account.name}</div>
                <div class="account-row-item__cell" data-type="account-name">${account.accountName}</div>
                <div class="account-row-item__cell" data-type="type">${account.type}</div>
                <div class="account-row-item__cell" data-type="location-count">Loading...</div> <!-- Placeholder for location count -->
            </div>
        `;
        accountRowsContainer.appendChild(accountRow);

        // Fetch location count for each account
        getAccountLocationsLength(account.name, accountRow.querySelector('[data-type="location-count"]'));
    });
};

const getAccountLocations = async (accountId) => {
    const url = getAccountLocationsUrl(accountId);

    try {
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
        console.log('Locations for Account:', data);
        // Process and display the locations data in the admin dashboard
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}

const getAllLocations = async () => {
    await fetch(HSRevApi.urls.locations, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': HSRevApi.nonce
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('All Locations:', data);
        // Process and display the locations data in the admin dashboard
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}

const getLocationReviews = async (accountId, locationId) => {
    const url = getReviewsUrl(accountId);

    await fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': HSRevApi.nonce
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Reviews for Location:', data);
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}
