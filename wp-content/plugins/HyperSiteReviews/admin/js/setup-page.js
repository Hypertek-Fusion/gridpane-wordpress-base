document.addEventListener('DOMContentLoaded', () => {
    const pages = document.querySelectorAll('.setup-page');
    const prevButton = document.querySelector('.page-prev');
    const nextButton = document.querySelector('.page-next');
    let currentPage = 0;

    // Account selection logic
    const accountSelect = document.getElementById('account-selection-table');

    // Function to check if any account is selected
    const isAnyAccountChecked = () => {
        const accountCheckboxes = accountSelect.querySelectorAll('input[type="checkbox"]');
        return Array.from(accountCheckboxes).some(cb => cb.checked);
    };

    const updateButtonState = () => {
        nextButton.disabled = !isAnyAccountChecked();
    };

    // Function to attach event listeners to checkboxes
    const attachCheckboxListeners = () => {
        const accountCheckboxes = accountSelect.querySelectorAll('input[type="checkbox"]');
        accountCheckboxes.forEach(c => {
            c.addEventListener('change', e => {
                const clickedCheckbox = e.target;
                const otherCheckboxes = Array.from(accountCheckboxes).filter(cb => cb !== clickedCheckbox);
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

        // Disable/enable buttons based on the current page
        prevButton.disabled = index === 0;
        nextButton.disabled = index === pages.length - 1 || !isAnyAccountChecked();
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
            currentPage++;
            showPage(currentPage);
        }
    });

    window.attachCheckboxListeners = attachCheckboxListeners;
});
