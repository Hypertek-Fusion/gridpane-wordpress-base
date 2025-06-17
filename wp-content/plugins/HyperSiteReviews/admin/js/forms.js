document.addEventListener('DOMContentLoaded', () => {
    const pages = document.querySelectorAll('.setup-page') || document.querySelectorAll('.reviews-page');
    const prevButton = document.querySelector('.page-prev');
    const nextButton = document.querySelector('.page-next');
    let currentPage = 0;
    let reviewsPerPage = 10; // Default reviews per page

    // Initialize window.HSRevData if not already done
    window.HSRevData = window.HSRevData || {};
    window.HSRevData.functions = window.HSRevData.functions || {};
    window.HSRevData.data = window.HSRevData.data || {};
    window.HSRevData.data.selectedReviews = new Set();

    // Prevent default form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevents the form from being submitted
        submitForm(); // Handle form submission
    });

    const isAnyCheckboxCheckedOnCurrentPage = () => {
        const currentCheckboxes = pages[currentPage].querySelectorAll('input:not([name="select-all-reviews"])[type="checkbox"]');
        return Array.from(currentCheckboxes).some(cb => cb.checked);
    };

    const selectAllReviews = (element) => {
        const reviewCheckboxes = pages[currentPage].querySelectorAll('input[name*="selected-review-"][type="checkbox"]');
        const locationId = window.HSRevData.data.locationId;
        const reviews = window.HSRevData.data.reviewsCache[locationId] || [];

        Array.from(reviewCheckboxes).forEach(cb => {
            const reviewId = cb.value;
            cb.checked = element.checked;
            if (element.checked) {
                window.HSRevData.data.selectedReviews.add(reviewId);
            } else {
                window.HSRevData.data.selectedReviews.delete(reviewId);
            }
        });

        updateHiddenInput();
        updateButtonState();
    };

    const updateHiddenInput = () => {
        const hiddenInput = document.getElementById('selected_reviews');
        const filteredReviewIds = Array.from(window.HSRevData.data.selectedReviews).filter(id => id.startsWith('AbFvOq'));
        hiddenInput.value = filteredReviewIds.join(',');
    };

    const getCheckedAccountId = () => {
        const selectedCheckbox = pages[0].querySelector('input[type="checkbox"]:checked');
        if (selectedCheckbox) {
            return selectedCheckbox.closest('.row-item').dataset.accountId;
        }
        return null;
    };

    const getCheckedLocationId = () => {
        const selectedCheckbox = pages[1].querySelector('input[type="checkbox"]:checked');
        if (selectedCheckbox) {
            return selectedCheckbox.closest('.row-item').dataset.locationId;
        }
        return null;
    };

    const updateButtonState = () => {
        if (currentPage !== 2) {
            nextButton.innerText = 'Next Page';
        } else {
            nextButton.innerText = 'Submit';
        }
        nextButton.disabled = !isAnyCheckboxCheckedOnCurrentPage();
    };

    const attachCheckboxListeners = (container) => {
        const checkboxes = container.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(c => {
            c.addEventListener('change', e => {
                const clickedCheckbox = e.target;
                const reviewId = clickedCheckbox.value;
                if (clickedCheckbox.checked) {
                    window.HSRevData.data.selectedReviews.add(reviewId);
                } else {
                    window.HSRevData.data.selectedReviews.delete(reviewId);
                }
                updateHiddenInput();
                updateButtonState();
            });
        });
    };

    const showPage = (index) => {
        pages.forEach((page, i) => {
            page.style.display = i === index ? 'block' : 'none';
        });

        prevButton.disabled = index === 0;
        updateButtonState();
    };

    showPage(currentPage);

    prevButton.addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            showPage(currentPage);
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentPage < pages.length - 1 && isAnyCheckboxCheckedOnCurrentPage()) {
            if (currentPage === 0) {
                const accountId = getCheckedAccountId();
                if (accountId && window.HSRevData.functions.getLocations) {
                    if (window.HSRevData.data.accountId !== accountId) {
                        console.log('Account changed, clearing location cache');
                        window.HSRevData.data.locationsCache = {};
                    }
                    window.HSRevData.functions.getLocations(accountId);
                    window.HSRevData.data.accountId = accountId;
                    console.log(`Account ID set: ${accountId}`);
                }
            } else if (currentPage === 1) {
                const locationId = getCheckedLocationId();
                if (locationId && window.HSRevData.functions.prefetchReviews) {
                    if (window.HSRevData.data.locationId !== locationId) {
                        console.log('Location changed, clearing review cache');
                        window.HSRevData.data.reviewsCache = {};
                    }
                    window.HSRevData.functions.prefetchReviews(locationId);
                    window.HSRevData.data.locationId = locationId;
                    console.log(`Location ID set: ${locationId}`);
                }
            }
            currentPage++;
            showPage(currentPage);
        } else if (currentPage === 2 && isAnyCheckboxCheckedOnCurrentPage()) {
            form.submit(); // Only submit the form when on the last page
        }
    });

    if (window.HSRevData && window.HSRevData.functions) {
        window.HSRevData.functions.attachCheckboxListeners = attachCheckboxListeners;
        window.HSRevData.functions.selectAllReviews = selectAllReviews;
    }

    if (pages[currentPage]) {
        attachCheckboxListeners(pages[currentPage]);
    }

    // Pagination Functions
    const reviewsPerPageSelect = document.getElementById('reviews-per-page');
    const updatePaginationControls = (totalItems, currentPage, itemsPerPage) => {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        document.getElementById('page-prev').disabled = currentPage <= 1;
        document.getElementById('page-next').disabled = currentPage >= totalPages;
    };

    const changePage = (newPage) => {
        const totalPages = Math.ceil(getTotalItems() / reviewsPerPage);
        if (newPage > 0 && newPage <= totalPages) {
            currentPage = newPage;
            showPageReviews(currentPage);
        }
    };

    const showPageReviews = (page) => {
        const pages = document.querySelectorAll('.reviews-page');
        pages.forEach((pageElement, index) => {
            pageElement.style.display = (index + 1 === page) ? 'block' : 'none';
        });

        updatePaginationControls(getTotalItems(), currentPage, reviewsPerPage);
    };

    const getTotalItems = () => {
        return document.querySelectorAll('.review-row').length;
    };

    document.getElementById('page-prev').addEventListener('click', () => changePage(currentPage - 1));
    document.getElementById('page-next').addEventListener('click', () => changePage(currentPage + 1));
    reviewsPerPageSelect.addEventListener('change', function () {
        reviewsPerPage = parseInt(this.value, 10);
        currentPage = 1; // Reset to first page on perPage change
        showPageReviews(currentPage);
    });

    showPageReviews(currentPage);
});


export { updatePaginationControls, changePage, showPageReviews, selectAllReviews };
