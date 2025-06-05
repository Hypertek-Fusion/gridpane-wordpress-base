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
         await fetch(HSRevApi.urls.accounts, {
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
            console.log('Accounts:', data);
            // Process and display the accounts data in the admin dashboard
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

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
