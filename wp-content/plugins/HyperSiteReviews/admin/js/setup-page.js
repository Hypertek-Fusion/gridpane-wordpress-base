document.addEventListener('DOMContentLoaded', () => {
    const pages = document.querySelectorAll('.setup-page');
    const prevButton = document.querySelector('.page-prev');
    const nextButton = document.querySelector('.page-next');
    let currentPage = 0;

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

    // Function to check if any checkbox is selected on the current page
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

    // Function to update the hidden input field with selected reviews
    const updateHiddenInput = () => {
        const hiddenInput = document.getElementById('selected_reviews');
        hiddenInput.value = Array.from(window.HSRevData.data.selectedReviews).join(',');
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
});
