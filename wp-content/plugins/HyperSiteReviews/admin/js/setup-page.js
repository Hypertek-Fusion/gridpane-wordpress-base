document.addEventListener('DOMContentLoaded', () => {
    const pages = document.querySelectorAll('.setup-page');
    const prevButton = document.querySelector('.page-prev');
    const nextButton = document.querySelector('.page-next');
    let currentPage = 0;

    // Initialize window.HSRevData if not already done
    window.HSRevData = window.HSRevData || {};
    window.HSRevData.functions = window.HSRevData.functions || {};
    window.HSRevData.data = window.HSRevData.data || {};

    // Prevent default form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevents the form from being submitted
    });

    // Function to check if any checkbox is selected on the current page
    const isAnyCheckboxCheckedOnCurrentPage = () => {
        const currentCheckboxes = pages[currentPage].querySelectorAll('input:not([name="select-all-reviews"])[type="checkbox"]');
        return Array.from(currentCheckboxes).some(cb => cb.checked);
    };

    const selectAllReviews = (element) => {
        const reviewCheckbox = pages[currentPage].querySelectorAll('input[name*="selected-review-"][type="checkbox"]');
        Array.from(reviewCheckbox).forEach(cb => cb.checked = element.checked);
        updateButtonState();
    }

    // Function to get the checked account ID
    const getCheckedAccountId = () => {
        const selectedCheckbox = pages[0].querySelector('input[type="checkbox"]:checked');
        if (selectedCheckbox) {
            return selectedCheckbox.closest('.row-item').dataset.accountId;
        }
        return null;
    };

    // Function to get the checked location ID
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

    // Attach checkbox event listeners
    const attachCheckboxListeners = (container) => {
        const checkboxes = container.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(c => {
            c.addEventListener('change', e => {
                const clickedCheckbox = e.target;
                const otherCheckboxes = Array.from(checkboxes).filter(cb => cb !== clickedCheckbox);
                otherCheckboxes.forEach(cb => cb.checked = false);

                updateButtonState();
            });
        });
    };

    // Function to show the current page and hide others
    const showPage = (index) => {
        pages.forEach((page, i) => {
            page.style.display = i === index ? 'block' : 'none';
        });

        prevButton.disabled = index === 0;
        updateButtonState();
    };

    // Initial setup
    showPage(currentPage);

    // Button event listeners
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
            // Only submit the form when on the last page
            form.removeEventListener('submit', (e) => e.preventDefault()); // Re-enable form submission
            form.submit();
        }
    });

    // Attach listeners for account checkboxes once they are populated
    if (window.HSRevData && window.HSRevData.functions) {
        window.HSRevData.functions.attachCheckboxListeners = attachCheckboxListeners;
        window.HSRevData.functions.selectAllReviews = selectAllReviews;
    }

    // Attach listeners to checkboxes on the initial page load
    if (pages[currentPage]) {
        attachCheckboxListeners(pages[currentPage]);
    }
});
