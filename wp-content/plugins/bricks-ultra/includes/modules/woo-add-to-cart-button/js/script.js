document.addEventListener("DOMContentLoaded", function(t) {
    if (bricksIsFrontend) {
        add_to_cart_button();
    }
});

function add_to_cart_button() {
    const buttons = bricksQuerySelectorAll(document, '.brxe-wpvbu-woo-add-to-cart-button');
    buttons.forEach((element) => {
        const atc = element.querySelectorAll(".bultr-add-to-cart");
        const viewCartButton = element.querySelectorAll(".bultr-view-cart-button");
        const settings = JSON.parse(element.getAttribute('data-settings'));

        atc.forEach(function (button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission

                const productId = button.value; // Get the product ID from the button value attribute
                const quantityInput = element.querySelector('.input-text');
                const qty = quantityInput ? quantityInput.value : '1';
                const url = bricksUltra.ajaxurl;
                const nonce = bricksUltra.nonce;

                var data = new URLSearchParams();
                data.append('action', 'bu_add_to_cart');
                data.append('product_id', productId);
                data.append('quantity', qty);
                data.append('bu_nonce', nonce);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: data
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.text();
                    } else {
                        throw new Error('Error: ' + response.status);
                    }
                })
                .then(function(responseText) {
                    if (settings.redirect == 'cart') {
                        const cart_url = bricksUltra.cart_url;
                        window.location.href = cart_url;
                        viewCartButton.forEach(function(btn) {
                            btn.style.display = 'none';
                        });
                    } else if (settings.redirect == 'checkout') {
                        const checkout_url = bricksUltra.checkout_url;
                        window.location.href = checkout_url;
                        viewCartButton.forEach(function(btn) {
                            btn.style.display = 'none';
                        });
                    } else if (settings.redirect == 'stay') {
                        viewCartButton.forEach(function(btn) {
                            btn.style.display = 'flex';
                        });
                    }
                    // render add to cart button icon before and after click
                    const beforeClickIcon = button.querySelector('.bultr-before-click-icon');
                    const afterClickIcon = button.querySelector('.bultr-after-click-icon');
                    beforeClickIcon.style.display = 'none';
                    afterClickIcon.style.display = 'inline-block';

                    // render add to cart button text before and after click
                    button.classList.add('bultr-after');
                    button.classList.remove('bultr-before'); 
                    

                })
                .catch(function(error) {
                    console.log(error);
                });

                if (settings.hide_fields == true) {
                    hideAddToCart();
                }
            });
        });

        function hideAddToCart() {
            const addToCartButton = element.querySelector('.bultr-add-to-cart');
            addToCartButton.style.display = 'none';
            const quantityInput =  element.querySelector('.input-text');
            quantityInput.style.display = 'none';
            viewCartButton.forEach(function(btn) {
                btn.style.display = 'none';
            });
        }
    });
}
