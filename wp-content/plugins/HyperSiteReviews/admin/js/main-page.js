document.addEventListener('DOMContentLoaded', async () => {
    if (window.HSRevData.functions.prefetchReviews) {
        await window.HSRevData.functions.prefetchReviews();
    }
})