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
    const url = HSRevApi.urls.accountLocations(accountId);

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
        console.log('Locations for Account:', data);
        // Process and display the locations data in the admin dashboard
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
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
    const url = HSRevApi.urls.reviews(accountId, locationId);

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
