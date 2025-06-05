document.addEventListener('DOMContentLoaded', () => {
    const pages = document.querySelectorAll('.setup-page');
    const prevButton = document.querySelector('.page-prev');
    const nextButton = document.querySelector('.page-next');
    let currentPage = 0;

    // Function to show the current page and hide others
    const showPage = (index) => {
        pages.forEach((page, i) => {
            page.style.display = i === index ? 'block' : 'none';
        });

        // Disable/enable buttons based on the current page
        prevButton.disabled = index === 0;
        nextButton.disabled = index === pages.length - 1;
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
        if (currentPage < pages.length - 1) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Account selection logic
    const accountSelect = document.getElementById('account-selection-table');
    const accountCheckboxes = accountSelect.querySelectorAll('input[type="checkbox"]');
    const accountSelectButton = nextButton; // Assuming you use the next button to proceed

    accountCheckboxes.forEach(c => {
        c.addEventListener('change', e => {
            const clickedCheckbox = e.target;
            const otherCheckboxes = Array.from(accountCheckboxes).filter(cb => cb !== clickedCheckbox);
            otherCheckboxes.forEach(cb => cb.checked = false);

            accountSelectButton.disabled = !Array.from(accountCheckboxes).some(cb => cb.checked);
        });
    });
});
