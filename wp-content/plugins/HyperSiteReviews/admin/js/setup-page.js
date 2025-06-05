document.addEventListener('DOMContentLoaded', () => {
    const accountSelect = document.getElementById('account-selection-table');
    const accountCheckboxes = accountSelect.querySelectorAll('input[type="checkbox"]');

    accountCheckboxes.forEach(c => {
        c.addEventListener('change', e => {
            const clickedCheckbox = e.target;
            const otherCheckboxes = Array.from(accountCheckboxes).filter(cb => cb !== clickedCheckbox);
            otherCheckboxes.forEach(cb => cb.checked = false);

            for(let i = 0; i < accountCheckboxes.length; i++) {
                if (accountCheckboxes[i].checked === true) {
                    accountSelectButton.disabled = false;
                    break;
                } else {
                    accountSelectButton.disabled = true;
                }
            }
        });
    });
})