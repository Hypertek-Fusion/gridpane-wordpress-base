let pages = null;
let currentPage = 0;
let reviewsPerPage = 10; // Default reviews per page
let prevButton = null;
let nextButton = null;

// Initialize the form and pagination functionality
document.addEventListener('reviewsInitialized', () => {
    initializeForm();
});

function initializeForm() {
    pages = document.querySelectorAll('.reviews-page');
    prevButton = document.querySelector('.page-prev');
    nextButton = document.querySelector('.page-next');

    // Initialize selected reviews or items
    window.HSRevData = window.HSRevData || {};
    window.HSRevData.data = window.HSRevData.data || {};
    window.HSRevData.data.selectedItems = new Set();

    // Prevent default form submission
    const form = document.querySelector('form');
    form && form.addEventListener('submit', onFormSubmit);

    // Attach event listeners
    attachEventListeners();

    // Show the initial page
    showPage(currentPage);
    showPageReviews(currentPage + 1); // Assuming page indices are 1-based for display
}

function onFormSubmit(e) {
    e.preventDefault();
    // Implement form submission logic, such as sending data via AJAX
    submitForm();
}

function attachEventListeners() {
    prevButton && prevButton.addEventListener('click', () => changePage(currentPage - 1));
    nextButton && nextButton.addEventListener('click', () => changePage(currentPage + 1));

    const reviewsPerPageSelect = document.getElementById('reviews-per-page');
    reviewsPerPageSelect && reviewsPerPageSelect.addEventListener('change', function () {
        reviewsPerPage = parseInt(this.value, 10);
        currentPage = 1; // Reset to first page on perPage change
        showPageReviews(currentPage);
    });

    if (pages[currentPage]) {
        attachCheckboxListeners(pages[currentPage]);
    }
}

function showPage(index) {
    pages.forEach((page, i) => {
        page.style.display = i === index ? 'block' : 'none';
    });

    prevButton.disabled = index === 0;
    updateButtonState();
}

function changePage(newPage) {
    const totalPages = Math.ceil(getTotalItems() / reviewsPerPage);
    if (newPage >= 0 && newPage < totalPages) {
        currentPage = newPage;
        showPageReviews(currentPage + 1); // Assuming page indices are 1-based for display
        updateButtonState();
    }
}

function updateButtonState() {
    if (pages) {
        nextButton.disabled = currentPage === pages.length - 1;
    }
}

function getTotalItems() {
    return document.querySelectorAll('.review-row').length;
}

function showPageReviews(page) {
    const reviewPages = document.querySelectorAll('.reviews-page');
    reviewPages.forEach((pageElement, index) => {
        pageElement.style.display = (index + 1 === page) ? 'block' : 'none';
    });

    updatePaginationControls(getTotalItems(), currentPage + 1, reviewsPerPage);
}

function updatePaginationControls(totalItems, currentPage, itemsPerPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    prevButton.disabled = currentPage <= 1;
    nextButton.disabled = currentPage >= totalPages;
}

function attachCheckboxListeners(container) {
    const checkboxes = container.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(cb => {
        cb.addEventListener('change', onCheckboxChange);
    });
}

function onCheckboxChange(e) {
    const clickedCheckbox = e.target;
    const itemId = clickedCheckbox.value;

    if (clickedCheckbox.checked) {
        window.HSRevData.data.selectedItems.add(itemId);
    } else {
        window.HSRevData.data.selectedItems.delete(itemId);
    }

    updateHiddenInput();
    updateButtonState();
}

function updateHiddenInput() {
    const hiddenInput = document.getElementById('selected_items');
    if (hiddenInput) {
        hiddenInput.value = Array.from(window.HSRevData.data.selectedItems).join(',');
    }
}

export { updatePaginationControls, changePage, showPageReviews, updateButtonState };

