const getReviews = async () => {
    try {
        const response = await fetch(HyperSiteReviews.urls.reviews, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': HyperSiteReviews.nonce
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();
        return data;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

document.addEventListener('DOMContentLoaded', async () => {
    const rev = await getReviews();

    console.log(rev);
})