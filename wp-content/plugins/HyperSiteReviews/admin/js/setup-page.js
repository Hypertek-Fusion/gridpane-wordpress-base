document.addEventListener('DOMContentLoaded', () => {
    const pages = document.querySelectorAll('.setup-page');
    const prevButton = document.querySelector('.page-prev');
    const nextButton = document.querySelector('.page-next');
    let currentPage = 0;

    // Account selection logic
    const accountSelect = document.querySelector('.selection-table[data-select-type="account"');

    // Function to check if any account is selected
    const isAnyAccountChecked = () => {
        const accountCheckboxes = accountSelect.querySelectorAll('input[type="checkbox"]');
        return Array.from(accountCheckboxes).some(cb => cb.checked);
    };

    const getCheckedAccountId = () => {
        const selectedCheckbox = accountSelect.querySelector('input[type="checkbox"]:checked');
        if (selectedCheckbox) {
            return selectedCheckbox.closest('.row-item').dataset.accountId;
        }
        return null;
    };

    const updateButtonState = () => {
        nextButton.disabled = !isAnyAccountChecked();
    };

    // Function to attach event listeners to checkboxes
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
        if (currentPage < pages.length - 1 && isAnyAccountChecked()) {
            const accountId = getCheckedAccountId();
            if (accountId && window.HSRevData.functions.getLocations) {
                window.HSRevData.functions.getLocations(accountId);
            }
            currentPage++;
            showPage(currentPage);
        }
    });

    // Attach listeners for account checkboxes once they are populated
    if (window.HSRevData && window.HSRevData.functions) {
        window.HSRevData.functions.attachCheckboxListeners = attachCheckboxListeners;
    }
});
