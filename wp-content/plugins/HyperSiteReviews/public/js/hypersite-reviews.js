const getAllReviews = async () => {
    try {
        let params = '';
        let moreReviews = true;

        do {
            const response = await fetch(HyperSiteReviews.urls.reviews + params, {
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

            data['reviews'].forEach((r) => {
                window.HyperSiteReviews.data.reviews.push(r);
            })

            if(data['total_pages'] === data['page']) {
                moreReviews = false;
            }

        } while(moreReviews)
        
        return window.HyperSiteReviews.data.reviews;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
};

document.addEventListener('DOMContentLoaded', async () => {
    window.HyperSiteReviews = window.HyperSiteReviews || {}
    window.HyperSiteReviews.urls =  window.HyperSiteReviews.urls || {}
    window.HyperSiteReviews.data = window.HyperSiteReviews.data || {}
    window.HyperSiteReviews.data.reviews = window.HyperSiteReviews.data.reviews || []

    const rev = await getAllReviews();

    console.log(rev);
})