document.addEventListener('DOMContentLoaded', function() {
    fetch(HSRevApi.url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': HSRevApi.nonce // Include the nonce
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
});