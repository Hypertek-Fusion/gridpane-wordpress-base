document.addEventListener('DOMContentLoaded', async () => {
    if (window.HyperSiteReviews) {
        await window.HSRevData.functions.prefetchReviews();
    }
})